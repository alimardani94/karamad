$(function () {

    $('#IranMap svg g path').hover(function () {
        var className = $(this).attr('class');
        var parentClassName = $(this).parent('g').attr('class');
        var itemName = $('#IranMap .list .' + parentClassName + ' .' + className + ' a').html();
        if (itemName) {
            $('#IranMap .list .' + parentClassName + ' .' + className).addClass('active');
            $('#IranMap .show-title').html(itemName).css({'display': 'block'});
        }
    }, function () {
        $('#IranMap .list li').removeClass('active');
        $('#IranMap .show-title').html('').css({'display': 'none'});
    });

    $('#IranMap .list ul li').hover(function () {
        var className = $(this).attr('class').split(' ').pop();
        var parentClassName = $(this).parent('ul').attr('class').split(' ').pop();
        var object = '#IranMap svg g.' + parentClassName + ' path.' + className;
        var currentClass = $(object).attr('class');
        $(object).attr('class', currentClass + ' hover');
    }, function () {
        var className = $(this).attr('class').split(' ').pop();
        var parentClassName = $(this).parent('ul').attr('class').split(' ').pop();
        var object = '#IranMap svg g.' + parentClassName + ' path.' + className;
        var currentClass = $(object).attr('class');
        $(object).attr('class', currentClass.replace(' hover', ''));
    });

    $('#IranMap .map').mousemove(function (e) {
        var posx = 0;
        var posy = 0;
        if (!e)
            var e = window.event;
        if (e.pageX || e.pageY) {
            posx = e.pageX;
            posy = e.pageY;
        } else if (e.clientX || e.clientY) {
            posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
            posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
        }
        if ($('#IranMap .show-title').html()) {
            var offset = $(this).offset();
            var x = (posx - offset.left + 25) + 'px';
            var y = (posy - offset.top - 5) + 'px';

            $('#IranMap .show-title').css({'left': x, 'top': y});
        }
    });

    $('#IranMap .map .province path').click(function () {
        var province = $(this).attr('class');
        var provinceLink = $('#IranMap .list li.' + province + ' a').attr('href');
        if (provinceLink) {
            window.location.href = provinceLink;
        }
    });

});
