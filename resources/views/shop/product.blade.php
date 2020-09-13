@extends('front/layout/base')

@section('title', 'فروشگاه')

@section('header')
    @include('header.header2')
@stop

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/OwlCarousel2-2.3.4/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slick/slick-theme.css') }}">
    <style>
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

        .slider-nav .slick-current {
            border: 5px solid #4285f4;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-2 pt-2">
        <!-- Section: product details -->
        <section id="productDetails" class="pb-5">

            <!-- News card -->
            <div class="card mt-5 hoverable">
                <div class="row mt-5">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="slick-container ltr m-3">
                                    <div id="mdb-lightbox-ui"></div>
                                    <div class="slider slider-for mdb-lightbox no-margin">
                                        @foreach($product->images() as $image)
                                            <figure class="text-center">
                                                <a href="{{ $image }}" data-size="1600x1067">
                                                    <img alt="{{  $product->name }}" src="{{ $image }}"
                                                         class="img-fluid mx-auto">
                                                </a>
                                            </figure>
                                        @endforeach
                                    </div>
                                    <div class="slider slider-nav my-2">
                                        @foreach($product->images() as $image)
                                            <div class="view">
                                                <img alt="{{  $product->name }}" src="{{ $image }}"
                                                     class="img-fluid mx-auto">
                                                <a>
                                                    <div class="mask rgba-white-slight"></div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 mr-3 text-center text-md-right">

                        <h2 class="h2-responsive text-center text-md-right product-name font-weight-bold dark-grey-text mb-1 ml-xl-0 ml-4">
                            <strong> {{ $product->name }} </strong>
                        </h2>

                        @foreach($product->tags as $tag)
                            <span class="badge badge-success product mb-4 ml-2">{{ $tag->name}}</span>
                        @endforeach
                        <h3 class="h3-responsive text-center text-md-right mb-5 ml-xl-0 ml-4">
                            <span
                                class="red-text font-weight-bold"><strong>{{ number_format($product->price) }}</strong></span>
                            <span class="grey-text"><small><s> {{ number_format($product->price) }}</s></small></span>
                        </h3>

                        <p class="ml-xl-0 ml-4">
                            {!! $product->description !!}
                        </p>

                        <!-- Add to Cart -->
                        <div class="row mt-3 mb-4">
                            <div class="col-md-12 text-center text-md-right text-md-right">
                                <a class="btn btn-primary btn-rounded"
                                   href="{{ route('shop.cart.add', ['product' => $product->id, 'count'=> '1']) }}">
                                    <i class="far fa-cart-plus ml-2" aria-hidden="true"></i>افزودن به سبد خر ید
                                </a>
                                @if( in_array($product->id, array_keys(Session::get('cart', [])) ))
                                    <a class="btn btn-secondary btn-rounded"
                                       href="{{ route('shop.cart.show') }}">
                                       برو به سبد خر ید
                                    </a>
                                @endif
                            </div>
                        </div>
                        <!-- Add to Cart -->
                    </div>
                </div>
            </div>
            <!-- News card -->
        </section>

        <section>
            @if($product->comments_count)

                <h4 class="h4-responsive dark-grey-text font-weight-bold my-5 text-center">
                    <strong>دیدگاه ها</strong>
                </h4>

                <hr class="mb-5">
                <div class="comments-list text-center text-md-left">
                    <div class="text-center my-5">
                        <h3 class="font-weight-bold">دیدگاه
                            <span class="badge indigo">{{ $product->comments_count }}</span>
                        </h3>
                    </div>

                    @foreach ($product->comments as $comment)
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
            @endif
        </section>

        <!-- Section: Products v.5 -->
        <section id="products" class="pb-5 mt-4">
            <hr>
            <h4 class="h4-responsive dark-grey-text font-weight-bold my-5 text-center">
                <strong>محصولات مرتبط</strong>
            </h4>

            <hr class="mb-5">

            <p class="text-center w-responsive mx-auto mb-5 dark-grey-text">
                بهترین و مناسبترین محصولات را از هوشکاپ تهیه کنید
            </p>

            <!-- Carousel Wrapper -->
            <div class="carousel-box courses-box">
                <div class="owl-carousel mt-4">
                    @foreach($relatedProducts as $relatedProduct)
                        @include('front.layout.single_product', ['product' => $product])
                    @endforeach
                </div>
            </div>
            <!-- Carousel Wrapper -->
        </section>
        <!-- Section: Products v.5 -->
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/vendor/OwlCarousel2-2.3.4/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/slick/slick.min.js') }}"></script>

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
                    items: 4
                }
            }
        })


        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            arrows: false,
            centerMode: true,
            focusOnSelect: true
        });

        $(function () {
            $("#mdb-lightbox-ui").load("{{ asset('assets/vendor/MDB-Pro_4.11.0/mdb-addons/mdb-lightbox-ui.html') }}");
        });

    </script>
@endsection

@section('footer')
@stop
