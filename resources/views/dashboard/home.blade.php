@extends('front/layout/base')

@section('title', 'داشبورد')

@section('header')
    @include('header.header2')
@stop

@section('content')
    <div class="container-fluid grey lighten-4">
        <div class="container">
            <div class="row mt-5 pt-3">
                <!-- Sidebar -->
                <div class="col-lg-3 col-12 mt-1">
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
                                    <a class="nav-link" id="v-pills-add-course-tab" data-toggle="pill"
                                       href="#v-pills-add-course" role="tab"
                                       aria-controls="v-pills-add-course" aria-selected="false">
                                        افزودن دوره
                                    </a>
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

                <div class="col-lg-9 col-12 mt-1 ">
                    <section class="pb-5 text-lg-left">

                        <div class="row mb-4">

                            <div class="col-md-12">

                                <div class="card">

                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active h-100" id="v-pills-home"
                                             role="tabpanel" aria-labelledby="v-pills-home-tab">
                                            <div class="card-title">داشبورد</div>
                                            <div class="card-body">

                                                1
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-add-course" role="tabpanel"
                                             aria-labelledby="v-pills-add-course-tab">
                                            <div class="card-title">افزودن دوره</div>
                                            <div class="card-body">

                                                3
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-courses" role="tabpanel"
                                             aria-labelledby="v-pills-courses-tab">
                                            <div class="card-title">دوره های من</div>
                                            <div class="card-body">

                                                3
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-online-courses" role="tabpanel"
                                             aria-labelledby="v-pills-online-courses-tab">
                                            <div class="card-title">کلاس آنلاین</div>
                                            <div class="card-body">

                                                <
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-transactions" role="tabpanel"
                                             aria-labelledby="v-pills-transactions-tab">
                                            <div class="card-title">مالی</div>
                                            <div class="card-body">

                                                6
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                             aria-labelledby="v-pills-profile-tab">
                                            <div class="card-title">پروفایل</div>
                                            <div class="card-body">

                                                2
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </section>
                </div>

            </div>
        </div>
    </div>

@endsection

