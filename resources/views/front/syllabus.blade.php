@extends('front/layout/base')

@section('title', $syllabus->title)

@section('header')
    @include('header.header1', [
    'headerBG' => asset('assets/img/header/header1.jpg'),
    'headerTitle' => $syllabus->title,
    ])
@stop

@section('style')
    <style>
        #syllabus_text img, #syllabus_text p {
            max-width: 100%;
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
                                                <strong>{{$syllabus->title}}</strong>
                                            </h4>
                                            <hr>
                                            <div class="view">
                                                @if($syllabus->type == \App\Enums\Syllabus\SyllabusType::Video)
                                                    <video controls class="img-fluid" width="100%">
                                                        <source src="{{$syllabus->video}}"
                                                                type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @elseif($syllabus->type == \App\Enums\Syllabus\SyllabusType::Audio)
                                                    <div class="m-5 text-center">
                                                        <audio controls>
                                                            <source src="{{$syllabus->audio}}"
                                                                    type="audio/mp3">
                                                            Your browser does not support the audio element.
                                                        </audio>
                                                    </div>
                                                @else
                                                    <div id="syllabus_text">
                                                        {!! $syllabus->text !!}}
                                                    </div>
                                                @endif
                                            </div>
                                            <hr>
                                            <p>{{$syllabus->summary}}</p>
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
                                    <strong>لیست فصل ها</strong>
                                </h5>

                                <div class="mt-3 dark-grey-text font-small text-center">
                                    <ul class="list-group mx-0 px-0">
                                        @foreach($syllabus->course->syllabuses as $syllabus)
                                            <li class="list-group-item text-black">
                                                <a href="{{route('syllabuses.show', ['syllabus' => $syllabus->id])}}"
                                                class="black-text">
                                                    {{$syllabus->title}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
