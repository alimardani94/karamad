@extends('front/layout/base')

@section('title', $course->title)

@section('header')
    @include('header.header1', [
    'headerBG' => asset('media/'.$course->image),
    'headerTitle' => $course->title
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
                                            <div id="course_description">{!! $course->description !!}</div>
                                        </div>

                                    </div>

                                    <div class="card mt-5">

                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <strong> سرفصل‌های {{$course->title}}</strong>
                                            </h4>
                                            <hr>

                                            @foreach($course->syllabuses as $syllabus)

                                                <ul class="list-group list-group-flush m-0 pr-0">
                                                    <ul class="list-group mr-0 pr-0">
                                                        @if($syllabus->type == \App\Enums\Syllabus\SyllabusType::Video)
                                                            <li class="list-group-item px-0">
                                                                <a href="{{route('syllabuses.show', ['syllabus' => $syllabus->id])}}"
                                                                   class="text-white btn-floating btn-tw btn-sm">
                                                                    <i class="fas fa-video"></i>
                                                                </a>
                                                                <a href="{{route('syllabuses.show', ['syllabus' => $syllabus->id])}}"
                                                                   class="black-text">
                                                                    {{$syllabus->title}}
                                                                </a>
                                                            </li>
                                                        @elseif($syllabus->type == \App\Enums\Syllabus\SyllabusType::Audio)
                                                            <li class="list-group-item px-0">
                                                                <a href="{{route('syllabuses.show', ['syllabus' => $syllabus->id])}}"
                                                                   class="text-white btn-floating btn-fb btn-sm">
                                                                    <i class="fas fa-volume-up"></i>
                                                                </a>
                                                                <a href="{{route('syllabuses.show', ['syllabus' => $syllabus->id])}}"
                                                                   class="black-text">
                                                                    {{$syllabus->title}}
                                                                </a>
                                                            </li>
                                                        @else
                                                            <li class="list-group-item px-0">
                                                                <a href="{{route('syllabuses.show', ['syllabus' => $syllabus->id])}}"
                                                                   class="text-white btn-floating btn-slack btn-sm">
                                                                    <i class="fas fa-text"></i>
                                                                </a>
                                                                <a href="{{route('syllabuses.show', ['syllabus' => $syllabus->id])}}"
                                                                   class="black-text">
                                                                    {{$syllabus->title}}
                                                                </a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </ul>
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
                                <h6 class="card-title dark-grey-text text-center grey lighten-4 py-2">
                                    <strong>مدرس </strong>
                                </h6>
                                <h6 class="card-title text-center ">
                                    {{$course->instructor->name}}
                                </h6>
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
