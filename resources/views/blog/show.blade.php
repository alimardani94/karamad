@extends('front/layout/base')

@section('title', $post->title)

@section('header')
    @include('header.header1', ['headerBG' => asset( 'media/' . $post->image)])
@stop

@section('style')
    <link rel="stylesheet" href="{{asset('assets/vendor/OwlCarousel2-2.3.4/assets/owl.carousel.min.css')}}">
    <style>
        #content p, #content img {
            max-width: 100%;
        }


        .owl-dots {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: center;
            justify-content: center;
            padding-left: 0;
            margin: 15px 15%;
        }

        .owl-dots .owl-dot {
            display: inline-block;
            zoom: 1;
        }

        .owl-dots .owl-dot span {
            margin: 5px 7px;
            display: block;
            -webkit-backface-visibility: visible;
            transition: opacity .2s ease;
            border-radius: 30px;
            width: 1.25rem;
            max-width: 1.25rem;
            height: 1.25rem;
            background-color: #4285f4;
        }

        .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span {
            width: 1.56rem;
            max-width: 1.56rem;
            height: 1.56rem;
            background-color: #4285f4;
            border-radius: 50%;
        }
    </style>
@endsection

@section('content')

    <div class="container-fluid mt-md-0 mt-5 mb-5">

        <div class="row" style="margin-top: -100px;">

            <div class="col-md-12 px-lg-5">
                <div class="card pb-5 mx-md-3">
                    <div class="card-body">
                        <div class="container">

                            <h1 class="text-center h1 pt-4 mb-3">
                                <strong>{{ $post->title }}</strong>
                            </h1>

                            <div class="row">
                                <div class="col-md-12 col-xl-12 d-flex justify-content-center">
                                    <p class="font-small dark-grey-text mb-1">
                                        <strong>نویسنده: </strong> {{ $post->author->full_name }}</p>
                                    <p class="font-small grey-text mb-0 ml-3">
                                        <i class="far fa-clock-o dark-grey-text"></i> {{ jDate($post->created_at, 'dd MMMM yyyy') }}
                                    </p>
                                </div>
                            </div>

                            <div class="row pt-lg-5 pt-3">

                                <div class="col-md-12 col-xl-12">

                                    <div id="content" class="mt-3">
                                        {!! $post->content !!}
                                    </div>

                                    <div class="row my-5">

                                        <div class="col-md-12 text-center">

                                            <h4 class="text-center font-weight-bold dark-grey-text mt-3 mb-3">
                                                <strong>به اشتراک بگزارید</strong>
                                            </h4>

                                            <a href="mailto:?subject={{ $post->title }}&amp;body={{ route('posts.show', ['post' => $post->id]) }}"
                                               type="button" class="btn btn-sm btn-email waves-effect waves-light">
                                                <i class="fas fa-envelope pr-1"></i>
                                                ایمیل
                                            </a>

                                            <a href="http://www.facebook.com/sharer.php?u={{ route('posts.show', ['post' => $post->id]) }}"
                                               target="_blank" type="button" class="btn btn-fb btn-sm">
                                                <i class="fab fa-facebook-f left"></i> Facebook
                                            </a>

                                            <a href="whatsapp://send?text={{ $post->title }}"
                                               data-action="share/whatsapp/share"
                                               type="button" class="btn  btn-sm btn-whatsapp waves-effect waves-light">
                                                <i class="fab fa-whatsapp pr-1"></i> Whatsapp
                                            </a>
                                        </div>

                                    </div>

                                    <hr class="mt-5">

                                    @if($post->comments_count)
                                        <section>
                                            <div class="comments-list text-center text-md-left">
                                                <div class="text-center my-5">
                                                    <h3 class="font-weight-bold">دیدگاه
                                                        <span class="badge indigo">{{ $post->comments_count }}</span>
                                                    </h3>
                                                </div>

                                                @foreach ($post->comments as $comment)
                                                    <div class="row mb-5">
                                                        <!-- Image column -->
                                                        <div class="col-sm-2 col-12 mb-3">
                                                            <img src="{{ $comment->image }}"
                                                                 class="avatar rounded-circle z-depth-1-half"
                                                                 alt="comment image">
                                                        </div>
                                                        <!-- Image column -->

                                                        <!-- Content column -->
                                                        <div class="col-sm-10 col-12">
                                                            <a>
                                                                <h5 class="user-name font-weight-bold">{{ $comment->name }}</h5>
                                                            </a>
                                                            <div class="card-data">
                                                                <ul class="list-unstyled">
                                                                    <li class="comment-date font-small">
                                                                        <i class="far fa-clock-o"></i> {{ jDate($comment->created_at, 'dd MMMM yyyy') }}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <p class="dark-grey-text article">
                                                                {{ $comment->body }}
                                                            </p>
                                                        </div>
                                                        <!-- Content column -->
                                                    </div>
                                                @endforeach
                                            </div>
                                        </section>
                                        <hr>
                                    @endif

                                    <section class="mb-4 wow fadeIn" data-wow-delay="0.2s">
                                        <h3 class="font-weight-bold text-center my-5">دیدگاه بگذارید</h3>
                                        <form action="{{ route('posts.comments.store', ['post' => $post->id ]) }}"
                                              method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12 mb-4">
                                                    <div class="input-group md-form form-sm form-3 pl-0">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text white black-text"
                                                                  id="basic-addon8">1</span>
                                                        </div>
                                                        <label for="name"></label>
                                                        <input type="text" id="name" name="name"
                                                               class="form-control mt-0 black-border rgba-white-strong"
                                                               placeholder="نام" aria-describedby="basic-addon9">
                                                    </div>

                                                </div>
                                                <!-- Grid column -->

                                                <!-- Grid column -->
                                                <div class="col-lg-6 col-md-6 mb-4">

                                                    <div class="input-group md-form form-sm form-3 pl-0">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text white black-text"
                                                                  id="basic-addon9">2</span>
                                                        </div>
                                                        <label for="email"></label>
                                                        <input type="email" id="email" name="email"
                                                               class="form-control mt-0 black-border rgba-white-strong"
                                                               placeholder="ایمیل" aria-describedby="basic-addon9">
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12 mt-1">
                                                    <div class="md-form">
                                                        <i class="fas fa-pencil-alt prefix"></i>
                                                        <textarea id="body" class="md-textarea form-control"
                                                                  rows="3" name="body"></textarea>
                                                        <label for="body" class="">دیدگاه</label>
                                                    </div>

                                                    <div class="text-right">
                                                        <button class="btn btn-grey btn-sm">ارسال</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>

                                    </section>

                                    <!-- Posts -->
                                    <section class="text-left mt-4">

                                        <h4 class="font-weight-bold mt-5 mb-5 text-center">
                                            <strong>پست های مرتبط</strong>
                                        </h4>

                                        <div class="carousel-box courses-box">
                                            <div class="owl-carousel mt-4">
                                                @foreach($relatedPosts as $relatedPost)
                                                    <div class="card m-2 h-100">

                                                        <!-- Card image -->
                                                        <div class="view overlay">
                                                            <img
                                                                src="{{ asset( 'media/' . $relatedPost->image) }}"
                                                                class="card-img-top" alt="sample image">
                                                            <a>
                                                                <div class="mask rgba-white-slight"></div>
                                                            </a>
                                                        </div>

                                                        <div class="card-body">
                                                            <h4 class="card-title">
                                                                <strong>{{ $relatedPost->title }}</strong>
                                                            </h4>
                                                            <hr>

                                                            <p class="font-small font-weight-bold dark-grey-text mb-1">
                                                                <i class="far fa-clock-o"></i> {{ jDate($relatedPost->created_at, 'dd MMMM yyyy') }}
                                                            </p>
                                                            <p class="font-small grey-text mb-0">{{ $relatedPost->meta_description }}</p>
                                                            <p class="text-right mb-0 font-small font-weight-bold">
                                                                <a href="{{ route('posts.show', ['post' => $relatedPost->id]) }}">بیشتر
                                                                    <i class="fas fa-angle-left"></i>
                                                                </a>
                                                            </p>
                                                        </div>

                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </section>
                                    <!-- Posts -->

                                </div>
                                <!-- Grid column -->

                            </div>
                            <!-- Grid row -->

                        </div>
                        <!-- Grid column -->

                    </div>
                    <!-- Grid row -->

                </div>
                <!-- Card -->
            </div>
            <!-- Grid column -->
        </div>
        <!-- Grid row -->
    </div>

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
            dots: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        })
    </script>
@endsection

@section('footer')
    @include('footer.footer2')
@stop
