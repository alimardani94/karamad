'use strict';

var isChannelReady = false;
var isInitiator = false;
var isStarted = [];
var localStream;
var peerConnections = [];
var remoteStream;
var turnReady;

const startButton = document.getElementById('startButton');
const hangupButton = document.getElementById('hangupButton');
hangupButton.disabled = true;

startButton.addEventListener('click', startAction);
hangupButton.addEventListener('click', hangupAction);

var pcConfig = {
    'iceServers': [{
        'urls': 'stun:stun.l.google.com:19302'
    }]
};

// Set up audio and video regardless of what devices are present.
var sdpConstraints = {
    offerToReceiveAudio: true,
    offerToReceiveVideo: true
};

/////////////////////////////////////////////

var room = courseKey;
var authId = userId;
// Could prompt for room name:
// room = prompt('Enter room name:');

var socket = io.connect('http://localhost:8080');

if (room !== '') {
    socket.emit('create or join', room);
    console.log('Attempted to create or  join room', room);
}

socket.on('created', function (room) {
    console.log('Created room ' + room);
    isInitiator = true;
});

socket.on('full', function (room) {
    console.log('Room ' + room + ' is full');
});

socket.on('join', function (room) {
    console.log('Another peer made a request to join room ' + room);
    console.log('This peer is the initiator of room ' + room + '!');
    isChannelReady = true;
});

socket.on('joined', function (room) {
    console.log('joined: ' + room);
    isChannelReady = true;
});

socket.on('log', function (array) {
    console.log.apply(console, array);
});

////////////////////////////////////////////////

function sendMessage(message) {

    let clientMsg = {
        'message': message,
        'room': room,
        'id': authId
    };

    console.log('Client sending message: ', clientMsg);

    socket.emit('message', clientMsg);
}

// This client receives a message
socket.on('message', function (message) {
    let msg = message.message;
    let id = message.id;
    console.log('Client received message:', msg);

    if (msg === 'got user media') {
        maybeStart(id);
    } else if (msg.type === 'offer') {
        if (!isInitiator && !isStarted[id]) {
            maybeStart(id);
        }
        peerConnections[id].setRemoteDescription(new RTCSessionDescription(msg));
        doAnswer(id);
    } else if (msg.type === 'answer' && isStarted[id]) {
        peerConnections[id].setRemoteDescription(new RTCSessionDescription(msg));
    } else if (msg.type === 'candidate' && isStarted[id]) {
        var candidate = new RTCIceCandidate({
            sdpMLineIndex: msg.label,
            candidate: msg.candidate
        });
        peerConnections[id].addIceCandidate(candidate);
    } else if (msg === 'bye' && isStarted[id]) {
        handleRemoteHangup(id);
    }
});

////////////////////////////////////////////////////

var localVideo = document.querySelector('#localVideo');
var remoteVideoBox = document.querySelector('#remoteVideoBox');

function startAction() {
    startButton.disabled = true;
    hangupButton.disabled = false;

    navigator.mediaDevices.getUserMedia({
        audio: false,
        video: true
    }).then(gotStream).catch(function (e) {
        alert('getUserMedia() error: ' + e.name);
    });
}

function hangupAction() {
    hangup();
    hangupButton.disabled = true;
}

function gotStream(stream) {
    console.log('Adding local stream.');
    localStream = stream;
    localVideo.srcObject = stream;
    sendMessage('got user media');
    if (isInitiator) {
        maybeStart(authId);
    }
}

var constraints = {
    video: true
};

console.log('Getting user media with constraints', constraints);

if (location.hostname !== 'localhost') {
    requestTurn(
        'https://computeengineondemand.appspot.com/turn?username=41784574&key=4080218913'
    );
}

function maybeStart(id) {
    console.log('>>>>>>> maybeStart() ', isStarted[id], localStream, isChannelReady);
    isStarted[id] = false;
    if (!isStarted[id] && typeof localStream !== 'undefined' && isChannelReady) {
        console.log('>>>>>> creating peer connection');
        createPeerConnection(id);
        peerConnections[id].addStream(localStream);
        isStarted[id] = true;
        console.log('isInitiator', isInitiator);
        if (isInitiator) {
            doCall(id);
        }
    }
}

window.onbeforeunload = function () {
    sendMessage('bye');
};

/////////////////////////////////////////////////////////

function createPeerConnection(id) {
    try {
        peerConnections[id] = new RTCPeerConnection(null);
        peerConnections[id].onicecandidate = function(event) {
            handleIceCandidate(event, id)
        };
        peerConnections[id].onaddstream = function (event) {
            handleRemoteStreamAdded(event, id)
        };
        peerConnections[id].onremovestream = function (event) {
            handleRemoteStreamRemoved(event, id)
        };

        console.log('Created RTCPeerConnnection');
    } catch (e) {
        console.log('Failed to create PeerConnection, exception: ' + e.message);
        alert('Cannot create RTCPeerConnection object.');
        return;
    }
}

function handleIceCandidate(event, id) {
    console.log('icecandidate event: ', event);
    if (event.candidate) {
        sendMessage({
            type: 'candidate',
            label: event.candidate.sdpMLineIndex,
            id: event.candidate.sdpMid,
            candidate: event.candidate.candidate,
            peerConnectionId: id
        });
    } else {
        console.log('End of candidates.');
    }
}

function handleCreateOfferError(event) {
    console.log('createOffer() error: ', event);
}

function doCall(id) {
    console.log('Sending offer to peer');

    peerConnections[id].createOffer().then(function (offer) {
        return peerConnections[id].setLocalDescription(offer);
    }).then(function () {
        console.log('setLocalAndSendMessage sending message', peerConnections[id].localDescription);
        sendMessage(peerConnections[id].localDescription);
    }).catch(onCreateSessionDescriptionError);
}

function doAnswer(id) {
    console.log('Sending answer to peer.');

    peerConnections[id].createAnswer().then(function (answer) {
        return peerConnections[id].setLocalDescription(answer);
    }).then(function () {
        console.log('setLocalAndSendMessage sending message', peerConnections[id].localDescription);
        sendMessage(peerConnections[id].localDescription);
    }).catch(onCreateSessionDescriptionError);
}

function onCreateSessionDescriptionError(error) {
    trace('Failed to create session description: ' + error.toString());
}

function requestTurn(turnURL) {
    var turnExists = false;
    for (var i in pcConfig.iceServers) {
        if (pcConfig.iceServers[i].urls.substr(0, 5) === 'turn:') {
            turnExists = true;
            turnReady = true;
            break;
        }
    }
    if (!turnExists) {
        console.log('Getting TURN server from ', turnURL);
        // No TURN server. Get one from computeengineondemand.appspot.com:
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var turnServer = JSON.parse(xhr.responseText);
                console.log('Got TURN server: ', turnServer);
                pcConfig.iceServers.push({
                    'urls': 'turn:' + turnServer.username + '@' + turnServer.turn,
                    'credential': turnServer.password
                });
                turnReady = true;
            }
        };
        xhr.open('GET', turnURL, true);
        xhr.send();
    }
}

function handleRemoteStreamAdded(event, id) {
    console.log('Remote stream added.');
    remoteStream = event.stream;

    let videoBox = '<div class="col-md-3 remoteVideoContainer"><video id="remoteVideo' + id + '" class="z-depth-1" autoplay playsinline></video></div>';
    remoteVideoBox.innerHTML += videoBox;

    document.querySelector('#remoteVideo' + id).srcObject = remoteStream;
}

function handleRemoteStreamRemoved(event, id) {
    console.log('Remote stream removed. Event: ', event, id);
}

function hangup() {
    console.log('Hanging up.');
    console.log(peerConnections);

    peerConnections.forEach(function (item, index) {
        stop(index);
    });
    sendMessage('bye');
}

function handleRemoteHangup(id) {
    console.log('Session terminated.');
    stop(id);
    isInitiator = false;
}

function stop(id) {
    isStarted[id] = false;
    peerConnections[id].close();
    peerConnections[id] = null;
    $('#remoteVideo' + id).parent('.remoteVideoContainer').remove();
}
