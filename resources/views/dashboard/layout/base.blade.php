<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="success" content="{{ session('success') }}">
    <meta name="error" content="{{ session('error') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('general.hooshcup') | @yield('title')</title>
    <link rel="shortcut icon" href="{{asset('assets/img/icon.png')}}">

    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/MDB-Pro_4.11.0/css/mdb.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/vendor/fontawesome-pro-5.12.0-web-ulabs/css/all.css')}}">

    <link href="{{asset('assets/css/header.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    @yield('style')
</head>

<body class="grey lighten-4">

@yield('header')

<main>
    <div class="container-fluid grey lighten-4">
        <div class="row mt-3 pt-3">
            <!-- Sidebar -->
            <div class="col-lg-3 col-12">
                <div class="card testimonial-card" style="max-width: 22rem;">
                    <div class="card-up aqua-gradient"></div>

                    <div class="avatar mx-auto white">
                        <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20%2831%29.jpg"
                             class="rounded-circle img-fluid">
                    </div>

                    <div class="card-body">
                        <h5 class="card-title dark-grey-text text-center">
                            <strong>{{$authUser->fullname}}</strong></h5>
                        <hr>
                        <div class="card-text pt-2">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                 aria-orientation="vertical">
                                <a class="nav-link active" data-toggle="pill" id="v-pills-home-tab"
                                   href="#v-pills-home" role="tab"
                                   aria-controls="v-pills-home" aria-selected="true">
                                    داشبورد
                                </a>
                                @if($authUser->isInstructor())
                                    <a class="nav-link" id="v-pills-add-course-tab" data-toggle="pill"
                                       href="#v-pills-add-course" role="tab"
                                       aria-controls="v-pills-add-course" aria-selected="false">
                                        افزودن دوره
                                    </a>
                                @endif
                                <a class="nav-link" id="v-pills-courses-tab" data-toggle="pill"
                                   href="#v-pills-courses" role="tab"
                                   aria-controls="v-pills-courses" aria-selected="false">
                                    دوره های من
                                </a>
                                <a class="nav-link" id="v-pills-online-courses-tab" data-toggle="pill"
                                   href="#v-pills-online-courses" role="tab"
                                   aria-controls="v-pills-online-courses" aria-selected="false">
                                    کلاس آنلاین
                                </a>
                                <a class="nav-link" id="v-pills-transactions-tab" data-toggle="pill"
                                   href="#v-pills-transactions" role="tab"
                                   aria-controls="v-pills-transactions" aria-selected="false">
                                    مالی
                                </a>
                                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill"
                                   href="#v-pills-profile" role="tab"
                                   aria-controls="v-pills-profile" aria-selected="false">
                                    پروفایل
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-9 col-12">
                <div class="card">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</main>

@include('footer.footer')

<script type="text/javascript" src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendor/popper/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendor/MDB-Pro_4.11.0/js/mdb.min.js')}}"></script>

<script type="text/javascript" src="{{asset('assets/js/main.js')}}"></script>
<script>
    $(function () {
        let hash = window.location.hash;
        hash && $('div.nav a[href="' + hash + '"]').tab('show');

        $('.nav-pills a').click(function (e) {
            $(this).tab('show');
            let scrollmem = $('body').scrollTop() || $('html').scrollTop();
            window.location.hash = this.hash;
            $('html,body').scrollTop(scrollmem);
        });
    });
</script>
@yield('js')

</body>

</html>
