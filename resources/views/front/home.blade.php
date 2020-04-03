@extends('front/layout/base')

@section('title', 'صفحه اصلی')

@section('header')
    @include('header.header1', ['headerBG' => asset('assets/img/slider/3.jpg')])
@stop

@section('style')
    <link rel="stylesheet" href="{{asset('assets/vendor/OwlCarousel2-2.3.4/assets/owl.carousel.min.css')}}">
    <style>

        @media (min-width: 769px) {
            .navbar:not(.top-nav-collapse) {
                box-shadow: none;
            }

            .navbar:not(.top-nav-collapse) {
                background: 0 0;
            }

            .navbar {
                background-color: #5991fb;
                box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);
            }
        }

        .header-intro {
            background-image: linear-gradient(whitesmoke, #c1f7ff, whitesmoke);
        }

        /* carousel style */
        .carousel-box {
            position: relative;
        }

        .carousel-box .custom-nav {
            position: absolute;
            top: 35%;
            left: 0;
            right: 0;
        }

        .carousel-box .custom-nav .owl-prev,
        .carousel-box .custom-nav .owl-next {
            position: absolute;
            height: 50px;
            width: 50px;
            color: inherit;
            background: none;
            z-index: 100;
            opacity: 0;
            border: 1px solid lightgray;
            border-radius: 50%;
            text-align: center;
            vertical-align: middle;
            background-color: #ffffffb5;
        }

        .carousel-box .custom-nav .owl-prev i,
        .carousel-box .custom-nav .owl-next i {
            font-size: 2.3rem;
            color: #510600;
            margin-top: 3px;
        }

        .carousel-box .custom-nav .owl-prev {
            left: 10px;
        }

        .carousel-box .custom-nav .owl-next {
            right: 10px;
        }

        .carousel-box:hover .custom-nav .owl-prev,
        .carousel-box:hover .custom-nav .owl-next {
            opacity: 1;
        }

        .carousel-box:hover .custom-nav .disabled {
            opacity: 0;
        }

        /* end carousel style */


        /* cards style*/
        .courses-box .card-img-top {
            height: 145px;
        }

        .courses-box .card-body .course-summary{
            height: 160px;
            overflow: hidden;
            font-size: 15px;
        }
        /* end cards style*/


    </style>
@endsection
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="font-weight-bold mt-5 mb-3">دوره های جدید</h6>

                    <div class="carousel-box courses-box">
                        <div class="owl-carousel mt-4">
                            @foreach($courses as $course)
                                <div class="card m-1">
                                    <div class="view overlay">
                                        <img src="{{asset('media/' .$course->thumbnail)}}" class="card-img-top"
                                             alt="{{$course->title}}">
                                        <a href="{{route('courses.show', ['course' => $course->id])}}">
                                            <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <a href="" class="teal-text text-center text-uppercase font-small"></a>
                                        <h5 class="card-title">
                                            <a href="{{route('courses.show', ['course' => $course->id])}}">
                                                <strong class="black-text">{{$course->title}}</strong>
                                            </a>
                                        </h5>
                                        <hr>
                                        <p class="dark-grey-text mb-4 course-summary">
                                            {{$course->summary}}
                                        </p>
                                        <p class="text-left mb-0 font-small">
                                            <a class="btn btn-default btn-sm" href="{{route('courses.show', ['course' => $course->id])}}">
                                                مشاهده
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="owl-controls">
                            <div class="custom-nav owl-nav"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="view header-intro rgba-gradient py-5">
        <div class="container h-100 d-flex justify-content-center align-items-center pt-3">
            <div class="row flex-center pt-5 mt-3">
                <div class="col-md-12 col-lg-7 text-center text-md-left margins">
                    <div class="black-text">
                        <h1 class="h2-responsive font-weight-bold wow fadeInRight" data-wow-delay="0.3s">
                            هوشکاپ گنجینه ای از کلاس های آموزشی
                        </h1>
                        <hr class="hr-light wow fadeInRight" data-wow-delay="0.3s">
                        <h6 class="wow fadeInRight" data-wow-delay="0.3s">
                            موضوع مورد نظر خود را جستجو کنید
                        </h6>
                        <br>
                        <form
                            class="form-inline d-flex justify-content-center wow fadeInRight md-form form-sm active-cyan active-cyan-2 mt-0">
                            <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="جستجو"
                                   aria-label="Search">
                            <i class="fas fa-search" aria-hidden="true"></i>
                        </form>
                    </div>
                </div>

                <div class="col-md-12 col-lg-5 wow fadeInLeft" data-wow-delay="0.3s">
                    <img src="{{asset('assets/img/table.png')}}" alt=""
                         class="img-fluid m-auto">
                </div>
            </div>
        </div>
    </section>


@endsection

@section('js')
    <script src="{{asset('assets/vendor/OwlCarousel2-2.3.4/owl.carousel.min.js')}}"></script>

    <script>
        $('.owl-carousel').owlCarousel({
            animateOut: 'slideOutDown',
            animateIn: 'flipInX',
            stagePadding: 1,
            rtl: true,
            loop: false,
            margin: 2,
            nav: true,
            navText: [
                '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                '<i class="fa fa-angle-right" aria-hidden="true"></i>'
            ],
            navContainer: '.carousel-box .custom-nav',
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        })
    </script>
@endsection
