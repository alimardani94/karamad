@extends('front/layout/base')

@section('title', 'صفحه اصلی')
@section('style')
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
                        <form class="form-inline d-flex justify-content-center wow fadeInRight md-form form-sm active-cyan active-cyan-2 mt-0">
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
        <div>

        </div>
    </section>
@endsection
