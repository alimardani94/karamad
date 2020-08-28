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
                    @if($posts->count())
                        <div class="row text-center py-4 mt-4">
                            <h2 class="font-weight-bold mx-auto">مقالات یافته شده</h2>
                        </div>
                        <div class="row my-3">
                            @foreach($posts as $post)
                                <div class="col-md-3">
                                    <div class="card m-1">
                                        <div class="view overlay">
                                            <img src="{{ asset('media/' .$post->image) }}" class="card-img-top"
                                                 alt="{{ $post->title }}">
                                            <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                                <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <a href="" class="teal-text text-center text-uppercase font-small"></a>
                                            <h5 class="card-title">
                                                <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                                    <strong class="black-text">{{$post->title}}</strong>
                                                </a>
                                            </h5>
                                            <hr>
                                            <div class="font-small blue-grey-text mb-0 text-right">
                                                <i class="fal fa-clock"></i> {{ jDate($post->created_at, 'dd MMMM yyyy') }}
                                            </div>
                                            <p class="text-left mb-0 font-small">
                                                <a class="btn btn-default btn-sm"
                                                   href="{{ route('posts.show', ['post' => $post->id]) }}">
                                                    مشاهده
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="row mb-3 mt-5">
                <div class="col-12">
                    {{ $courses->links() }}
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
