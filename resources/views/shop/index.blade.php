@extends('front/layout/base')

@section('title', 'فروشگاه')

@section('header')
    @include('header.header2', ['headerBG' => asset('assets/img/slider/3.jpg')])
@stop

@section('style')

@endsection

@section('content')


    <div class="container">
        <div class="row pt-4">
            <div class="col-lg-12">

                <section class="section pt-4">
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="card card-ecommerce">
                                    <div class="view overlay">
                                        <img src="{{ asset('media/' . $product->image) }}"
                                             class="img-fluid" alt="{{ $product->name }}">
                                        <a href="{{ route('shop.product', ['id' => $product->id]) }}">
                                            <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                        </a>
                                    </div>
                                    <!-- Card image -->

                                    <!-- Card content -->
                                    <div class="card-body">

                                        <h5 class="card-title mb-1">
                                            <strong><a href="{{ route('shop.product', ['id' => $product->id]) }}" class="dark-grey-text">{{ $product->name }}</a></strong>
                                        </h5>
                                        <span class="badge badge-danger mb-2">bestseller</span>

                                        <ul class="rating">
                                            <li><i class="fas fa-star blue-text"></i></li>
                                            <li><i class="fas fa-star blue-text"></i></li>
                                            <li><i class="fas fa-star blue-text"></i></li>
                                            <li><i class="fas fa-star blue-text"></i></li>
                                            <li><i class="fas fa-star blue-text"></i></li>
                                        </ul>

                                        <div class="card-footer pb-0">
                                            <div class="row mb-0">
                                                <span class="float-left">
                                                    <strong>{{ number_format($product->price) }}</strong>  تومان
                                                </span>

                                                <span class="float-left">
                                                    <a class="" data-toggle="tooltip" data-placement="top" title=""
                                                       data-original-title="Add to Cart">
                                                        <i class="fas fa-shopping-cart ml-3"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection

@section('footer')
@stop
