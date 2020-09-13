@extends('front/layout/base')

@section('title', 'مقاله')

@section('header')
    @include('header.header1', ['headerBG' => asset('assets/img/header/books.jpg'), 'headerTitle' => 'مقالات'])
@stop

@section('style')

@endsection

@section('content')

    <section>
        <div class="container-fluid grey lighten-4">
            <div class="container">
                <div class="row mt-5 pt-3">
                    @if($posts->count())
                        <div class="col-lg-8 col-12 mt-1 mx-lg-4">
                            <section class="pb-3 text-center text-lg-left">
                                @foreach($posts as $post)
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="view overlay">
                                                    <img src="{{ asset('media/' . $post->image) }}"
                                                         class="card-img-top"
                                                         alt="{{ $post->title }}">
                                                    <a>
                                                        <div class="mask rgba-white-slight"></div>
                                                    </a>
                                                </div>
                                                <div class="card-body mx-4">
                                                    <div class="font-small blue-grey-text mb-0 text-left float-left">
                                                        <i class="fal fa-clock"></i> {{ jDate($post->created_at, 'dd MMMM yyyy') }}
                                                    </div>
                                                    <h4 class="card-title">
                                                        <strong>{{ $post->title }}</strong>
                                                    </h4>
                                                    <hr>
                                                    <p class="dark-grey-text mb-4">
                                                        {{ $post->meta_description }}
                                                    </p>
                                                    <p class="text-left mb-0 text-uppercase dark-grey-text font-weight-bold">
                                                        <a type="button"
                                                           class="btn btn-outline-primary btn-rounded waves-effect"
                                                           href="{{ route('posts.show', ['post' => $post->id, 'slug' => $post->slug]) }}">
                                                            بیشتر
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </section>

                            <nav class="mb-5 pb-2">
                                {{ $posts->links() }}
                            </nav>
                        </div>

                        <div class="col-lg-3 col-12 mt-1">
                            @if($popularPosts->count())
                                <section class="section widget-content mb-5">
                                    <div class="card card-body pb-0">
                                        <p class="font-weight-bold dark-grey-text text-center spacing grey lighten-4 py-2 mb-4">
                                            <strong>مقالات محبوب</strong>
                                        </p>

                                        @foreach($popularPosts as $post)
                                            <div class="single-post">
                                                <div class="row mb-4">
                                                    <div class="col-5">
                                                        <!-- Image -->
                                                        <div class="view overlay">
                                                            <img src="{{ asset( 'media/' . $post->image) }}"
                                                                 class="img-fluid z-depth-1 rounded-0"
                                                                 alt="{{ $post->title }}">
                                                            <a href="{{ route('posts.show', ['post' => $post->id, 'slug' => $post->slug]) }}">
                                                                <div class="mask waves-light"></div>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="col-7">
                                                        <h6 class="mt-0 font-small">
                                                            <a href="{{ route('posts.show', ['post' => $post->id, 'slug' => $post->slug]) }}"
                                                               class="black-text">
                                                                <strong>{{ $post->title }}</strong>
                                                            </a>
                                                        </h6>

                                                        <div class="post-data">
                                                            <p class="font-small grey-text mb-0">
                                                                <i class="fal fa-clock"></i> {{ jDate($post->created_at, 'yyyy/MM/dd') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </section>
                            @endif

                            @if($tags->count())
                                <section class="section mb-5">
                                    <div class="card card-body pb-0">
                                        <p class="font-weight-bold dark-grey-text text-center spacing grey lighten-4 py-2 mb-4">
                                            <strong>برچسب ها</strong>
                                        </p>
                                        <div class="single-post">
                                            <ul class="list-group mb-4">
                                                @foreach($tags as $tag)
                                                    @if($tag->posts_count)
                                                        <li class="list-group-item d-flex justify-content-between
                                                      align-items-center {{ ($tag->id == request()->get('tag')) ? 'active' : '' }}">
                                                            <a href="{{ route('posts.filter', ['tag' => $tag->id]) }}">
                                                                <p class="mb-0 black-text"> {{ $tag->name}} </p>
                                                            </a>
                                                            <span class="badge teal badge-pill">
                                                    {{ $tag->posts_count}}
                                                </span>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </section>
                            @endif
                        </div>
                    @else
                        <div class="col-lg-12">
                            <div class="alert alert-primary mt-3 mb-5" role="alert">
                                هبچ مقالی ای یافت نشد
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- Blog section -->

    <!-- Latest posts -->
    <section>
        <div class="container-fluid white mb-0 pb-0">
            <hr class="mt-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <h6 class="font-weight-bold mt-5 mb-3">درباره ما</h6>
                        <hr class="mb-5">
                        <img src="{{ asset('assets/img/inteligence-gray.png') }}" alt="inteligente"
                             class="img-fluid z-depth-1">
                        <p class="mt-4 mb-5">
                            با هوشکاپ هر آنچه که برای آموزش خود نیاز دارید، با بهترین کیفیت دریافت کنید وبا شرکت در کلاس
                            های آنلاین حالش رو ببرید.
                        </p>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <h6 class="font-weight-bold mt-5 mb-3">مقالات محبوب</h6>
                        <hr class="mb-5">
                        @foreach($popularPosts as $post)
                            <div class="row">
                                <div class="col-4">
                                    <div class="view overlay z-depth-1 mb-3">
                                        <img src="{{ asset( 'media/' . $post->image) }}" class="img-fluid"
                                             alt="{{ $post->title}}">
                                        <a href="{{ route('posts.show', ['post' => $post->id, 'slug' => $post->slug]) }}">
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-8 mb-1">
                                    <div class="">
                                        <p class="mb-1">
                                            <a href="{{ route('posts.show', ['post' => $post->id, 'slug' => $post->slug]) }}"
                                               class="text-hover font-weight-bold">
                                                {{ $post->title}}
                                            </a>
                                        </p>
                                        <p class="font-small grey-text">
                                            <em> {{jDate($post->created_at, 'yyyy/MM/dd') }} </em>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <h6 class="font-weight-bold mt-5 mb-3">جدیدترین ها</h6>
                        <hr class="mb-5">
                        @foreach($newestPosts as $post)
                            <div class="row">
                                <div class="col-4">
                                    <div class="view overlay z-depth-1 mb-3">
                                        <img src="{{ asset( 'media/' . $post->image) }}" class="img-fluid"
                                             alt="{{ $post->title}}">
                                        <a href="{{ route('posts.show', ['post' => $post->id, 'slug' => $post->slug]) }}">
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-8 mb-1">
                                    <div class="">
                                        <p class="mb-1">
                                            <a href="{{ route('posts.show', ['post' => $post->id, 'slug' => $post->slug]) }}"
                                               class="text-hover font-weight-bold">
                                                {{ $post->title}}
                                            </a>
                                        </p>
                                        <p class="font-small grey-text">
                                            <em> {{jDate($post->created_at, 'yyyy/MM/dd') }} </em>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </section>


@endsection

@section('js')

@endsection

@section('footer')
    @include('footer.footer2')
@stop
