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

                                            @if($syllabus->attachments)
                                                <hr>
                                                <h4>پیوست ها</h4>
                                                <div class="row wow fadeIn" data-wow-delay="0.4s"
                                                     style="visibility: visible; animation-name: fadeIn; animation-delay: 0.4s;">
                                                    @foreach($syllabus->attachments() as $attachment)
                                                        <div class="col-md-3 mb-5">
                                                            <div class="card card-body  {{$attachment->color}}
                                                                lighten-3 hoverable text-center">
                                                                <i class="{{$attachment->icon}} fa-3x mb-4 mt-3
                                                                white-text text-center"
                                                                   aria-hidden="true"></i>
                                                                <h5 class="feature-title font-weight-bold white-text
                                                                text-uppercase text-center">
                                                                    <a target="_blank" class="white-text text-center"
                                                                       href="{{$attachment->path}}">
                                                                        {{$attachment->title}}
                                                                    </a>
                                                                </h5>
                                                                <a target="_blank" class="white-text text-center"
                                                                   href="{{$attachment->path}}">
                                                                    دانلود
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
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

                        <div class="card mt-5">
                            <div class="card-body">
                                <h6 class="card-title dark-grey-text text-center grey lighten-4 py-2">
                                    <strong>مدرس </strong>
                                </h6>
                                <h6 class="card-title text-center ">
                                    {{$syllabus->course->instructor->name}}
                                </h6>
                                <p class="mt-3 dark-grey-text font-small text-center">
                                    {{$syllabus->course->instructor->about}}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
