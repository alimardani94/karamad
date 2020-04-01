@extends('front/layout/base')

@section('title', 'صفحه اصلی')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/vendor/OwlCarousel2-2.3.4/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/OwlCarousel2-2.3.4/assets/owl.theme.default.min.css')}}">
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
            background-image: linear-gradient(white, white, #c1f7ff, #b1dcfb, #c1f7ff, white);
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
            height: 100px;
            color: inherit;
            background: none;
            border: none;
            z-index: 100;
            opacity: 0.1;
        }

        .carousel-box .custom-nav .owl-prev i,
        .carousel-box .custom-nav .owl-next i {
            font-size: 2.5rem;
            color: #cecece;
        }

        .carousel-box .custom-nav .owl-prev {
            left: 0;
        }

        .carousel-box .custom-nav .owl-next {
            right: 0;
        }

        .carousel-box:hover .custom-nav .owl-prev,
        .carousel-box:hover .custom-nav .owl-next {
            opacity: 1;
        }

        .carousel-box:hover .custom-nav .disabled {
            opacity: 0.2;
        }

        /* end carousel style */


    </style>
@endsection
@section('content')
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

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="font-weight-bold mt-5 mb-3">دوره های جدید</h6>

                    <div class="carousel-box">
                        <div class="owl-carousel mt-4">
                            @foreach($courses as $course)
                                <div class="card m-2">
                                    <div class="view overlay">
                                        <img src="{{asset('media/' .$course->thumbnail)}}" class="card-img-top"
                                             alt="{{$course->title}}">
                                        <a>
                                            <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                        </a>
                                    </div>
                                    <div class="card-body mx-1">
                                        <a href="" class="teal-text text-center text-uppercase font-small"></a>
                                        <h6 class="mb-3 mt-3">
                                            <a href="" class="teal-text text-center text-uppercase font-small">
                                                <strong>{{$course->category->name}}</strong>
                                            </a>
                                            <a class="dark-grey-text font-small">
                                                - {{jDate($course->created_at, 'yyyy/MM/dd')}}</a>
                                        </h6>
                                        <h4 class="card-title">
                                            <strong>{{$course->title}}</strong>
                                        </h4>
                                        <hr>
                                        <p class="dark-grey-text mb-4">
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

@endsection

@section('js')
    <script src="{{asset('assets/vendor/OwlCarousel2-2.3.4/owl.carousel.min.js')}}"></script>

    <script>
        $('.owl-carousel').owlCarousel({
            animateOut: 'slideOutDown',
            animateIn: 'flipInX',
            autoHeight: true,
            stagePadding: 30,
            rtl: true,
            loop: false,
            margin: 10,
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
