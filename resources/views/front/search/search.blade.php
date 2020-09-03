@extends('front/layout/base')

@section('title', 'جستجو')

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
                    @if($courses->count())
                        <div class="row text-center py-4 mt-4">
                            <h2 class="font-weight-bold mx-auto">دوره های یافته شده</h2>
                        </div>
                        <div class="row row-cols-1 row-cols-md-4">
                            @foreach($courses as $course)
                                <div class="col my-3">
                                    @include('front.layout.single_course', ['course' => $course])
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center mb-5">
                            <a href="{{ route('course.search', ['q' => request()->get('q')]) }}"
                               class="btn btn-outline-info btn-rounded waves-effect z-depth-0">
                                مشاهده بیشتر
                            </a>
                        </div>
                    @endif

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
                        <div class="text-center mb-5">
                            <a href="{{ route('product.search', ['q' => request()->get('q')]) }}"
                               class="btn btn-outline-info btn-rounded waves-effect z-depth-0">
                                مشاهده بیشتر
                            </a>
                        </div>
                    @endif

                    @if($posts->count())
                        <div class="row text-center py-4 mt-4">
                            <h2 class="font-weight-bold mx-auto">مقالات یافته شده</h2>
                        </div>
                        <div class="row row-cols-1 row-cols-md-4">
                            @foreach($posts as $post)
                                <div class="col my-3">
                                    @include('front.layout.single_post', ['post' => $post])
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center mb-5">
                            <a href="{{ route('post.search', ['q' => request()->get('q')]) }}"
                               class="btn btn-outline-info btn-rounded waves-effect z-depth-0">
                                مشاهده بیشتر
                            </a>
                        </div>
                    @endif

                    @if(!$courses->count() and !$products->count() and !$posts->count())
                        <div class="alert alert-primary my-5 p-4" role="alert">
                            دستاوردی برای جستجوی شما یافت نشد
                        </div>
                    @endif

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
