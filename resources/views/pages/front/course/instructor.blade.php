@extends('pages.front.layout.base')

@section('title', $instructor->name)

@section('meta')
    <meta name="keywords" content="{{ $instructor->name }}">
@endsection

@section('header')
    @include('pages.header.header1', [
    'headerBG' => asset('assets/img/header/instructor.jpg'),
    'headerTitle' => $instructor->name
    ])
@stop

@section('style')
    <style>
        #course_description p {
            max-width: 100% !important;
        }
    </style>
@endsection

@section('content')
    <section>
        <div class="container z-depth-1 py-5 my-5">
            <section class="mx-md-5 text-center text-lg-left">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="row p-5">
                            <div class="col-lg-8 d-flex flex-column justify-content-between">
                                <div>
                                    <p class="font-weight-bold lead mb-2"><strong>{{ $instructor->name }}</strong></p>
                                    <p class="font-weight-bold text-muted">{{ $instructor->id }}</p>
                                </div>
                                <p class="text-muted mb-4">{{ $instructor->about }}</p>
                            </div>
                            @if($instructor->image)
                                <div class="col-lg-4 d-flex mb-2 align-items-center">
                                    <div
                                        class="avatar mx-4 w-100 white d-flex justify-content-center align-items-center">
                                        <img src="{{ $instructor->image }}"
                                             class="rounded-circle img-fluid z-depth-1" alt="woman avatar">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <section>
        <div class="container-fluid grey lighten-4">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-md-12">
                        @if($courses->count())
                            <section>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="row text-center py-4 mt-4">
                                            <h2 class="font-weight-bold mx-auto">دوره های این مدرس</h2>
                                        </div>
                                        <div class="row row-cols-1 row-cols-md-4">
                                            @foreach($courses as $course)
                                                <div class="col my-3">
                                                    @include('pages.front.layout.single_course', ['course' => $course])
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row mb-3 mt-5">
                                            <div class="col-12">
                                                {{ $courses->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
@endsection
