@extends('front/layout/base')

@section('title', 'جستجو محصول')

@section('header')
    @include('header.header1', ['headerBG' => asset('assets/img/slider/2.jpg')])
@stop

@section('style')
@endsection
@section('content')
    <section>
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12">
                    @if($products->count())
                        <div class="row text-center py-4 mt-4">
                            <h2 class="font-weight-bold mx-auto">محصولات یافته شده</h2>
                        </div>
                        <div class="row row-cols-1 row-cols-md-4">
                            @foreach($products as $product)
                                <div class="col my-3">
                                    @include('front.layout.single_product', ['product' => $product])
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="row mb-3 mt-5">
                <div class="col-12">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
@endsection

@section('footer')
    @include('footer.footer1')
@stop
