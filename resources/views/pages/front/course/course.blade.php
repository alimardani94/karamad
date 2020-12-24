@extends('pages.front.layout.base')

@section('title', $course->title)

@section('meta')
    <meta name="description" content="{{ $course->meta_description }}">
    <meta name="keywords" content="{{ $course->meta_keywords }}">
@endsection

@section('header')
    @include('pages.header.header1', [
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
                                                                <a href="{{ route('syllabuses.show', ['syllabus' => $syllabus->id, 'slug' => $syllabus->slug]) }}"
                                                                   class="text-white btn-floating btn-tw btn-sm">
                                                                    <i class="far fa-video"></i>
                                                                </a>
                                                                <a href="{{ route('syllabuses.show', ['syllabus' => $syllabus->id, 'slug' => $syllabus->slug]) }}"
                                                                   class="black-text">
                                                                    {{$syllabus->title}}
                                                                </a>
                                                            </li>
                                                        @elseif($syllabus->type == \App\Enums\Syllabus\SyllabusType::Audio)
                                                            <li class="list-group-item px-0">
                                                                <a href="{{ route('syllabuses.show', ['syllabus' => $syllabus->id, 'slug' => $syllabus->slug]) }}"
                                                                   class="text-white btn-floating btn-fb btn-sm">
                                                                    <i class="far fa-volume-up"></i>
                                                                </a>
                                                                <a href="{{ route('syllabuses.show', ['syllabus' => $syllabus->id, 'slug' => $syllabus->slug]) }}"
                                                                   class="black-text">
                                                                    {{$syllabus->title}}
                                                                </a>
                                                            </li>
                                                        @elseif($syllabus->type == \App\Enums\Syllabus\SyllabusType::Text)
                                                            <li class="list-group-item px-0">
                                                                <a href="{{ route('syllabuses.show', ['syllabus' => $syllabus->id, 'slug' => $syllabus->slug]) }}"
                                                                   class="text-white btn-floating btn-fb btn-sm">
                                                                    <i class="far fa-align-justify"></i>
                                                                </a>
                                                                <a href="{{ route('syllabuses.show', ['syllabus' => $syllabus->id, 'slug' => $syllabus->slug]) }}"
                                                                   class="black-text">
                                                                    {{$syllabus->title}}
                                                                </a>
                                                            </li>
                                                        @else
                                                            <li class="list-group-item px-0">
                                                                <a href="{{ route('syllabuses.show', ['syllabus' => $syllabus->id, 'slug' => $syllabus->slug]) }}"
                                                                   class="text-white btn-floating btn-yt btn-sm">
                                                                    <i class="fal fa-list-alt"></i>
                                                                </a>
                                                                <a href="{{ route('syllabuses.show', ['syllabus' => $syllabus->id, 'slug' => $syllabus->slug]) }}"
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
                        <div style="position: sticky; top: 90px;">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title dark-grey-text text-center grey lighten-4 py-2">
                                        <strong>لیست فصل ها</strong>
                                    </h5>

                                    <div class="mt-3 dark-grey-text font-small text-center">
                                        <ul class="list-group mx-0 px-0">
                                            @foreach($course->syllabuses as $sidebarSyllabus)
                                                <li class="list-group-item text-black">
                                                    <a href="{{ route('syllabuses.show', ['syllabus' => $sidebarSyllabus->id, 'slug' => $sidebarSyllabus->slug]) }}"
                                                       class="black-text">
                                                        @if($sidebarSyllabus->type == \App\Enums\Syllabus\SyllabusType::Video)
                                                            <i class="far fa-video pl-1"></i>
                                                        @elseif($sidebarSyllabus->type == \App\Enums\Syllabus\SyllabusType::Audio)
                                                            <i class="far fa-volume-up pl-1"></i>
                                                        @elseif($sidebarSyllabus->type == \App\Enums\Syllabus\SyllabusType::Text)
                                                            <i class="far fa-align-justify pl-1"></i>
                                                        @else
                                                            <i class="far fa-question pl-1"></i>
                                                        @endif
                                                        {{$sidebarSyllabus->title}}
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
                                    <h6 class="card-title text-center">
                                        <a href="{{ route('instructors.show', ['instructor' => $course->instructor->id, 'slug' => $course->instructor->slug]) }}"
                                           class="black-text">
                                            {{ $course->instructor->name }}
                                        </a>
                                    </h6>
                                    <p class="mt-3 dark-grey-text font-small text-center">
                                        {{ $course->instructor->about }}
                                    </p>
                                </div>
                            </div>

                            @if(auth()->id())
                                <div class="card mt-5">
                                    <div class="card-body">
                                        <a style="display:{{$course->reaction() == 1 ? 'block' : 'none'}}"
                                           id="dislike"
                                           data-link="{{ route('courses.react', ['course' =>$course->id]) }}">
                                            <i class="fas fa-heart fa-2x pl-1" style="color: red"
                                               aria-hidden="true"></i>
                                            <span class="pb-2" style="vertical-align:super"> حذف از علاقه مندی</span>
                                        </a>
                                        <a style="display:{{$course->reaction() != 1 ? 'block' : 'none'}}"
                                           id="like" data-link="{{ route('courses.react', ['course' =>$course->id]) }}">
                                            <i class="fal fa-heart fa-2x pl-1" style="color: rgba(48, 56, 64, .2)"
                                               aria-hidden="true"></i>
                                            <span class="pb-2" style="vertical-align:super"> افزودن به علاقه مندی</span>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        $('#like, #dislike').click(function () {
            let button = $(this)
            let type, anotherBtn;
            let link = button.attr('data-link');

            if (button.attr('id') === 'like') {
                anotherBtn = $('#dislike');
                type = 1;
            } else {
                anotherBtn = $('#like');
                type = 2;
            }

            $.ajax({
                method: 'post',
                url: link,
                data: JSON.stringify({
                    type: type,
                }),
                contentType: 'application/json',
                dataType: 'json',
            }).done(function (response) {
                button.css('display', 'none');
                anotherBtn.css('display', 'block');
            }).fail(function (response) {
                console.log(response);
            });
        });
    </script>
@endsection
