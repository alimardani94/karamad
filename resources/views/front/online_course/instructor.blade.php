@extends('front/layout/base')

@section('title', ' کلاس آنلاین ' .  $onlineCourse->title)

@section('header')
    @include('header.header2')
@stop

@section('style')
@endsection
@section('content')
    <div class="container">
        <section class="section mt-5 pb-3 wow fadeIn">
            <div class="row">
                <div class="col-md-9">
                    <div id="localVideoContainer" class="z-depth-1">
                        <video id="localVideo" autoplay playsinline></video>
                        <div id="localVideoToolBar" class="col-md-3 col-xl-1 m-4 wow fadeInRight">
                            <a type="button" class="btn-floating btn-ins"><i class="fal fa-video"></i></a>
                            <a type="button" class="btn-floating btn-ins"><i class="far fa-microphone"></i></a>
                            <a type="button" class="btn-floating btn-ins"><i class="fal fa-record-vinyl"></i></a>
                            <a type="button" class="btn-floating btn-ins"><i class="fal fa-compress-wide"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card testimonial-card" style="max-width: 22rem;">
                        <div class="card-up aqua-gradient">

                        </div>

                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section mt-5 pb-3 wow fadeIn">
            <div class="row">
                <div class="col-md-3">
                    <video style="width: 100%" class="z-depth-1"></video>
                </div>
                <div class="col-md-3">
                    <video style="width: 100%" class="z-depth-1"></video>
                </div>
                <div class="col-md-3">
                    <video style="width: 100%" class="z-depth-1"></video>
                </div>
                <div class="col-md-3">
                    <video style="width: 100%" class="z-depth-1"></video>
                </div>
            </div>
        </section>

    </div>
@endsection

@section('js')
    <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>

@endsection
