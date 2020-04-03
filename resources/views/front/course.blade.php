@extends('front/layout/base')

@section('title', $course->title)

@section('header')
    @include('header.header1', ['headerBG' => asset('media/'.$course->image)])
@stop

@section('style')
    <style>

    </style>
@endsection

@section('content')
    <section>
        <div class="container-fluid grey lighten-4">
            <div class="container">
                <div class="row mt-5 pt-3">
                    <div class="col-lg-9 col-12 mt-1 ">
                        <section class="pb-5 text-lg-left">

                            <div class="row mb-4">

                                <div class="col-md-12">

                                    <div class="card">

                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <strong>{{$course->title}}</strong>
                                            </h4>
                                            <hr>
                                            <div>{!! $course->description !!}</div>
                                        </div>

                                    </div>

                                    <div class="card mt-5">

                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <strong> سرفصل‌های {{$course->title}}</strong>
                                            </h4>
                                            <hr>

                                            @foreach($course->syllabuses as $syllabus)
                                                <div class="d-flex align-items-center">
                                                    @if($syllabus->type == \App\Enums\Syllabus\SyllabusType::Video)
                                                        <a href="{{route('syllabuses.show', ['syllabus' => $syllabus->id])}}"
                                                           class="btn-floating btn-sm btn-success">
                                                            <i class="fas fa-video"></i>
                                                        </a>
                                                    @elseif($syllabus->type == \App\Enums\Syllabus\SyllabusType::Audio)
                                                        <a href="{{route('syllabuses.show', ['syllabus' => $syllabus->id])}}"
                                                           class="btn-floating btn-sm btn-primary">
                                                            <i class="fas fa-volume-up"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{route('syllabuses.show', ['syllabus' => $syllabus->id])}}"
                                                           class="btn-floating btn-sm btn-default">
                                                            <i class="fas fa-text"></i>
                                                        </a>
                                                    @endif
                                                    <a href="{{route('syllabuses.show', ['syllabus' => $syllabus->id])}}"
                                                       class=" mx-2">{{$syllabus->title}}</a>
                                                </div>

                                                @if(!$loop->last)
                                                    <hr class="my-1">
                                                @endif
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-3 col-12 mt-1">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title dark-grey-text text-center grey lighten-4 py-2">
                                    <strong>{{$course->instructor->name}}</strong>
                                </h5>

                                <p class="mt-3 dark-grey-text font-small text-center">
                                    {{$course->instructor->about}}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
