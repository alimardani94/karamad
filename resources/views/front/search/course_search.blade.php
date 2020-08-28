@extends('front/layout/base')

@section('title', 'جستجو دوره')

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
                        <div class="row my-3">
                            @foreach($courses as $course)
                                <div class="col-md-3">
                                    <div class="card m-1">
                                        <div class="view overlay">
                                            <img src="{{ asset('media/' .$course->thumbnail) }}" class="card-img-top"
                                                 alt="{{ $course->title }}">
                                            <a href="{{ route('courses.show', ['course' => $course->id]) }}">
                                                <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <a href="" class="teal-text text-center text-uppercase font-small"></a>
                                            <h5 class="card-title">
                                                <a href="{{ route('courses.show', ['course' => $course->id]) }}">
                                                    <strong class="black-text">{{$course->title}}</strong>
                                                </a>
                                            </h5>
                                            <hr>
                                            <p class="dark-grey-text mb-4 course-summary">
                                                {{ $course->summary }}
                                            </p>
                                            <p class="text-left mb-0 font-small">
                                                <a class="btn btn-default btn-sm"
                                                   href="{{ route('courses.show', ['course' => $course->id]) }}">
                                                    مشاهده
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mb-3 mt-5">
                            <div class="col-12">
                                {{ $courses->links() }}
                            </div>
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
