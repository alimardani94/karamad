<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('general.hooshcup') | @yield('title')</title>
    <link rel="shortcut icon"  href="{{asset('assets/img/logo.jpg')}}">

    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/MDB-Pro_4.11.0/css/mdb.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/vendor/fontawesome-pro-5.12.0-web-ulabs/css/all.css')}}">

    <link href="{{asset('assets/css/header.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    @yield('style')
</head>

<body>

@include('header.header')

<main>
    @yield('content')
</main>

@include('footer.footer')

<script type="text/javascript" src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendor/popper/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendor/MDB-Pro_4.11.0/js/mdb.min.js')}}"></script>

<script type="text/javascript" src="{{asset('assets/js/main.js')}}"></script>
@yield('js')

</body>

</html>
