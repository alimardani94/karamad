@extends('front/layout/base')

@section('title', ' کلاس آنلاین ' .  $onlineCourse->title)

@section('header')
    @include('header.header2')
@stop

@section('style')
    <style>
        video {
            max-width: 100%;
        }

    </style>
@endsection
@section('content')
    <div class="container">
        <section class="section mt-5 pb-3 wow fadeIn">
            <div class="row">
                <div class="col-md-9">
                    <div id="localVideoContainer">
                        <video id="localVideo" poster="{{asset('assets/img/black-video-poster.jpg')}}"
                               class="z-depth-1" autoplay muted playsinline>
                        </video>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card testimonial-card" style="max-width: 22rem;">
                        <div class="card-body">
                            <div class="list-group-flush">
                                <button class="btn btn-primary btn-rounded btn-block mt-3" id="startButton">
                                    <i class="fas fa-play mr-1"></i> شروع
                                </button>

                                <button class="btn btn-danger btn-rounded btn-block mt-3" id="hangupButton">
                                    <i class="fas fa-stop-circle mr-1"></i> قطع
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section mt-5 pb-3 wow fadeIn">
            <div class="row">
                <div class="col-md-3">
                    <video id="remoteVideo" class="z-depth-1" autoplay playsinline></video>
                </div>
                <div class="col-md-3">
                    <video id="remoteVideo2" class="z-depth-1" autoplay playsinline></video>
                </div>
                <div class="col-md-3">
                    <video id="remoteVideo3" class="z-depth-1" autoplay playsinline></video>
                </div>
                <div class="col-md-3">
                    <video id="remoteVideo4" class="z-depth-1" autoplay playsinline></video>
                </div>
            </div>
        </section>

    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
    <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
    <script>
        const courseKey = '{{$onlineCourse->key}}';
        const userId = '{{$authUser->id ?? ''}}';
    </script>
    <script src="{{asset('assets/js/stream2.js')}}"></script>

@endsection

