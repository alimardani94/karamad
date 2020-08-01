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

        .question_card {
            display: none;
        }

        .question_card:first-of-type {
            display: block;
        }

        .fa-times.question_validation_icon {
            position: absolute;
            right: -13px;
            font-size: 1.1rem;
        }

        .fa-check.question_validation_icon {
            position: absolute;
            right: -17px;
            font-size: 1.1rem;
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
                                            <div class="">
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
                                                @elseif($syllabus->type == \App\Enums\Syllabus\SyllabusType::Text)
                                                    <div id="syllabus_text">
                                                        {!! $syllabus->text !!}
                                                    </div>
                                                @else
                                                    گزینه صحیح را انتخاب کنید
                                                    <hr>
                                                    @foreach($syllabus->questions as $index=>$question)
                                                        <div class="card question_card" id="question_card_{{ $index }}">
                                                            <div class="card-body">
                                                                <h4 class="card-title">{!! $question->title !!}</h4>
                                                                <input type="hidden" id="answer_{{$question->id}}"
                                                                       value="{{$question->answer}}">

                                                                <div class="card-text">
                                                                    <div class="form-check mr-4">
                                                                        <input type="radio" class="form-check-input"
                                                                               id="{{$question->id}}_a" value="a"
                                                                               name="question_{{$question->id}}">
                                                                        <label class="form-check-label"
                                                                               for="{{$question->id}}_a">{!! $question->a !!}</label>
                                                                    </div>

                                                                    <div class="form-check mr-4">
                                                                        <input type="radio" class="form-check-input"
                                                                               id="{{$question->id}}_b" value="b"
                                                                               name="question_{{$question->id}}">
                                                                        <label class="form-check-label"
                                                                               for="{{$question->id}}_b">{!! $question->b !!}</label>
                                                                    </div>
                                                                    <div class="form-check mr-4">
                                                                        <input type="radio" class="form-check-input"
                                                                               id="{{$question->id}}_c" value="c"
                                                                               name="question_{{$question->id}}">
                                                                        <label class="form-check-label"
                                                                               for="{{$question->id}}_c">{!! $question->c !!}</label>
                                                                    </div>
                                                                    <div class="form-check mr-4">
                                                                        <input type="radio" class="form-check-input"
                                                                               id="{{$question->id}}_d" value="d"
                                                                               name="question_{{$question->id}}">
                                                                        <label class="form-check-label"
                                                                               for="{{$question->id}}_d">{!! $question->d !!}</label>
                                                                    </div>
                                                                    <div class="mt-4 mb-0"  id="{{$question->id}}_answer_reason"
                                                                         style="display: none">
                                                                        {!! $question->answer_reason !!}
                                                                    </div>
                                                                </div>

                                                                <br>
                                                                <button class="btn btn-primary btn-sm submitBtn"
                                                                        onclick="answerQuestion({{$question->id}})">
                                                                    ارسال
                                                                </button>
                                                                @if ($loop->last)
                                                                    <button class="btn btn-primary btn-sm getScoreBtn"
                                                                            style="display: none"
                                                                            onclick="getScore()">
                                                                        مشاهده نتیجه
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-primary btn-sm goToNextBtn"
                                                                            style="display: none"
                                                                            onclick="goToNext({{$index + 1}})">
                                                                        بعدی
                                                                    </button>
                                                                @endif
                                                            </div>

                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>

                                            @if($syllabus->attachments())
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

@section('js')
    <script>
        let score = 0;
        let questionsCount = {{ $syllabus->questions->count() }};

        function answerQuestion(id) {
            let value = $('input[name=question_' + id + ']:checked').val();
            let answer = $('#answer_' + id).val();

            $('#' + id + '_' + answer).parents('.form-check')
                .prepend('<i class="far fa-check green-text question_validation_icon"></i>');

            if (value !== answer) {
                $('#' + id + '_' + value).parents('.form-check')
                    .prepend('<i class="far fa-times red-text question_validation_icon"></i>');
            } else {
                score++
            }
            $('#' + id + '_answer_reason').show();

            $('.submitBtn').hide();
            $('.goToNextBtn').show();
            $('.getScoreBtn').show();
        }

        function goToNext(id) {
            $('.question_card').slideUp();
            $('#question_card_' + id).slideDown();
            $('.submitBtn').show();
            $('.goToNextBtn').hide();
            $('.getScoreBtn').hide();
        }

        function getScore() {
            let finalScore = score * 100 / questionsCount;
            let html = "شما به " + finalScore +  " درصد سوالات پاسخ صحیح دادید"
            $('.question_card').html(html);
        }
    </script>
@endsection

