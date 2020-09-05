@extends('front/layout/base')

@section('title', 'فروشگاه')

@section('header')
    @include('header.header2')
@stop

@section('style')

@endsection

@section('content')
    <div class="container">
        <div class="row pt-4">
            <div class="col-lg-12">
                <section class="section pt-4">
                    <div class="row row-cols-1 row-cols-md-4">
                        @if($products->count())
                            @foreach($products as $product)
                                <div class="col my-3">
                                    @include('front.layout.single_product', ['product' => $product])
                                </div>
                            @endforeach
                        @else
                            <div class="col-lg-12">
                                <div class="alert alert-primary p-5 mt-3 mb-5" role="alert">
                                    هبچ محصولی یافت نشد
                                </div>
                            </div>
                        @endif
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
