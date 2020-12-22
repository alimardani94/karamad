@extends('pages.front.layout.base')

@section('title',  $product->name)

@section('meta')
    <meta name="description" content="{{ $product->meta_description }}">
    <meta name="keywords" content="{{ $product->meta_keywords }}">
@endsection

@section('header')
    @include('pages.header.header2')
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
    </style>
@endsection

@section('content')
    <div class="container mt-1">
        <section id="productDetails" class="pb-5">
            <div class="card mt-5 hoverable">
                <div class="row">
                    <div class="col-lg-5">
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
                    <div class="col-lg-7">
                        <div class="m-3 mt-5">
                            <h2 class="h2-responsive text-center text-md-right product-name font-weight-bold dark-grey-text mb-1 ml-xl-0 ml-4">
                                <strong> {{ $product->name }} </strong>
                            </h2>

                            <div class="my-2">
                                @foreach($product->tags as $tag)
                                    <span class="badge badge-success product m-1 mt-2">{{ $tag->name}}</span>
                                @endforeach
                            </div>

                            <h3 class="h3-responsive text-center text-md-right my-4">
                                @if($product->discount)
                                    <span class="grey-text">
                                        <small>
                                            <s>{{ number_format($product->price) }}</s>
                                        </small>
                                    </span>
                                @endif
                                <span class="red-text font-weight-bold">
                                    <strong>{{ number_format($product->final_price) }}</strong>
                                </span>
                                تومان
                            </h3>

                            <p class="mt-0">
                                {!! $product->summery !!}
                            </p>

                            <div class="d-flex justify-content-end mt-3 mb-4 mx-4">
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
                    </div>
                </div>
            </div>
        </section>

        <div class="classic-tabs">
            <div class="tabs-wrapper">
                <ul class="nav tabs-blue" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link waves-light waves-effect waves-light active" data-toggle="tab"
                           href="#detail" role="tab" aria-selected="true">
                            جزئیات
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-light waves-effect waves-light" data-toggle="tab"
                           href="#attributes" role="tab" aria-selected="false">
                            ویژگی‌ها
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-light waves-effect waves-light" data-toggle="tab"
                           href="#comments" role="tab" aria-selected="false">
                            دیدگاه‌ها
                        </a>
                    </li>

                </ul>
            </div>

            <div class="tab-content card p-5">
                <div class="tab-pane fade in active show" id="detail" role="tabpanel">
                    <div class="w-100">
                        {!! $product->description !!}
                    </div>
                </div>

                <div class="tab-pane fade" id="attributes" role="tabpanel">
                    <ul>
                        @foreach($product->features() as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="tab-pane fade" id="comments" role="tabpanel">
                    @if($product->comments_count)
                        <h4 class="h4-responsive dark-grey-text font-weight-bold my-5 text-center">
                            <strong>دیدگاه‌ها</strong>
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
                                    <div class="col-sm-2 col-12 mb-3">
                                        <img src="{{ $comment->image }}"
                                             class="avatar rounded-circle z-depth-1-half"
                                             alt="comment image">
                                    </div>
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
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="dark-grey mb-4">
                            هنوز هیچ دیدگاهی ثبت نشده است.
                        </p>
                    @endif
                </div>

            </div>
        </div>

        @if($relatedProducts->count())
            <section id="products" class="pb-5 mt-4">
                <hr>
                <h4 class="h4-responsive dark-grey-text font-weight-bold my-5 text-center">
                    <strong>محصولات مرتبط</strong>
                </h4>

                <hr class="mb-5">

                <p class="text-center w-responsive mx-auto mb-5 dark-grey-text">
                    بهترین و مناسبترین محصولات را از هوشکاپ تهیه کنید
                </p>

                <div class="carousel-box courses-box">
                    <div class="owl-carousel mt-4">
                        @foreach($relatedProducts as $relatedProduct)
                            @include('pages.front.layout.single_product', ['product' => $relatedProduct])
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
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
            focusOnSelect: true,
            infinite: false
        });

        $(function () {
            $("#mdb-lightbox-ui").load("{{ asset('assets/vendor/MDB-Pro_4.11.0/mdb-addons/mdb-lightbox-ui.html') }}");
        });

    </script>
@endsection

@section('footer')
@stop
