<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@lang('general.hooshcup') | مدیریت | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('assets/admin/adminLTE/css/bootstrap-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/adminLTE/css/rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome-pro-5.12.0-web-ulabs/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/adminLTE/components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/adminLTE/components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/adminLTE/css/AdminLTE.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/adminLTE/css/skins/_all-skins.min.css') }}">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    @yield('style')
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <a href="{{route('admin.home')}}" class="logo">
            <span class="logo-mini">پنل</span>
            <span class="logo-lg"><b>کنترل پنل مدیریت</b></span>
        </a>

        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li> <a href="{{route('home')}}">نمایش سایت</a> </li>

                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fal fa-envelope"></i>
                            <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">۴ پیام خوانده نشده</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-right">
                                                <img src="{{asset('assets/img/avatars/avatar.png')}}" class="img-circle"
                                                     alt="User Image">
                                            </div>
                                            <h4>
                                                علیرضا
                                                <small><i class="fa fa-clock-o"></i> ۵ دقیقه پیش</small>
                                            </h4>
                                            <p>متن پیام</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">نمایش تمام پیام ها</a></li>
                        </ul>
                    </li>

                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fal fa-bell"></i>
                            <span class="label label-warning">۱۰</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">۱۰ اعلان جدید</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> ۵ کاربر جدید ثبت نام کردند
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-warning text-yellow"></i> اخطار دقت کنید
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li class="footer"><a href="#">نمایش همه</a></li>
                        </ul>
                    </li>

                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('assets/img/avatars/avatar.png')}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ $authUser->full_name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="{{asset('assets/img/avatars/avatar.png')}}" class="img-circle"
                                     alt="User Image">
                                <p>
                                    {{ $authUser->full_name }}
                                </p>
                            </li>

                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">پروفایل</a>
                                </div>
                                <div class="pull-left">
                                    <a href="{{route('auth.sign-out')}}" class="btn btn-default btn-flat">خروج</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-right image">
                    <img alt="" src="{{asset('assets/img/avatars/avatar.png')}}" class="img-circle">
                </div>
                <div class="pull-left info">
                    <p>{{$authUser->full_name}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i>
                        نقش
                    </a>
                </div>
            </div>
            <ul class="sidebar-menu" data-widget="tree">
                @include('admin.sidebar.sidebar')
            </ul>
        </section>
    </aside>
    <div class="content-wrapper">
        <div id="message" class="ok">
        </div>
        <div id="message" class="error">
        </div>
        @yield('header')
        <section class="content">
            <br>
            @yield('content')
        </section>
    </div>
    <footer class="main-footer">توسعه داده شده با <a href="https://alimardani.me" target="_blank"><i class="far fa-heart red"></i></a>
    </footer>
    <div class="control-sidebar-bg"></div>
</div>

<script src="{{ asset('assets/admin/adminLTE/components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/admin/adminLTE/components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/admin/adminLTE/components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('assets/admin/adminLTE/components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{ asset('assets/admin/adminLTE/js/adminlte.min.js')}}"></script>
<script src="{{ asset('assets/admin/adminLTE/js/demo.js')}}"></script>

@yield('script')
</body>
</html>
