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
    <link rel="shortcut icon" href="{{ asset('assets/img/icon.png') }}">

    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/MDB-Pro_4.11.0/css/mdb.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome-pro-5.12.0-web-ulabs/css/all.css') }}">

    <link href="{{ asset('assets/css/header.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    @yield('style')
</head>

<body class="grey lighten-4">

@yield('header')

<main>
    <div class="container-fluid grey lighten-4">
        <div class="row mt-3 pt-3">
            <!-- Sidebar -->
            <div class="col-lg-3 col-12">
                <div class="card testimonial-card mb-4">
                    <div class="card-up aqua-gradient"></div>

                    <div class="avatar mx-auto white">
                        <img src="{{ $authUser->image }}" alt="{{ $authUser->fullname }}"
                             class="rounded-circle img-fluid">
                    </div>

                    <div class="card-body">
                        <h5 class="card-title dark-grey-text text-center d-none d-md-block">
                            <strong>{{ $authUser->fullname }}</strong></h5>
                        <hr>
                        <div class="card-text pt-2">
                            <div class="nav flex-column nav-pills" id="tab" role="tablist"
                                 aria-orientation="vertical">
                                <a class="nav-link active" data-toggle="pill" id="home-tab"
                                   href="#home" role="tab"
                                   aria-controls="home" aria-selected="true">
                                    داشبورد
                                </a>
                                @if($authUser->isInstructor())
                                    <a class="nav-link" id="add-course-tab" data-toggle="pill"
                                       href="#add-course" role="tab"
                                       aria-controls="add-course" aria-selected="false">
                                        افزودن دوره
                                    </a>
                                @endif
                                <a class="nav-link" id="courses-tab" data-toggle="pill"
                                   href="#courses" role="tab"
                                   aria-controls="courses" aria-selected="false">
                                    دوره های من
                                </a>
                                <a class="nav-link" id="orders-tab" data-toggle="pill"
                                   href="#orders" role="tab"
                                   aria-controls="orders" aria-selected="false">
                                    سفارشات
                                </a>
                                <a class="nav-link" id="transactions-tab" data-toggle="pill"
                                   href="#transactions" role="tab"
                                   aria-controls="transactions" aria-selected="false">
                                    مالی
                                </a>
                                <a class="nav-link" id="profile-tab" data-toggle="pill"
                                   href="#profile" role="tab"
                                   aria-controls="profile" aria-selected="false">
                                    پروفایل
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-9 col-12">
                @yield('content')
            </div>
        </div>
    </div>
</main>

@yield('footer')

<script type="text/javascript" src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/popper/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/MDB-Pro_4.11.0/js/mdb.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome-pro-5.12.0-web-ulabs/css/all.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/toastr-2.1.1/toastr.min.css') }}">

<script src="{{ asset('assets/vendor/toastr-2.1.1/toastr.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
<script>
    let toastPosition = 'toast-bottom-left';
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        toastPosition = 'toast-top-center';
    }
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": toastPosition,
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    let success = $('meta[name=success]').attr("content");
    let error = $('meta[name=error]').attr("content");

    if (success !== '') {
        toastr.success(success);
    }
    if (error !== '') {
        toastr.error(error);
    }

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
