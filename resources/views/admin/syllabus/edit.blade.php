@extends('admin.layout.base')

@section('title', 'خانه')
@section('syllabus', 'active menu-open')
@section('syllabus2', 'active')

@section('style')
    <style>
        .attachments_row {
            border: solid 1px lightgrey;
            margin: 2px 10px;
            padding: 5px;
        }

        .remove_attachment_container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80px;
            width: 100%;
        }

        .questions_row {
            border: solid 1px lightgrey;
            margin: 2px 10px;
            padding: 5px;
        }

        .remove_question_container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80px;
            width: 100%;
        }

    </style>
@endsection

@section('header')
    <section class="content-header">
        <h1>
            افزودن جلسه جدید
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">جلسه ها</a></li>
            <li class="active">افزودن جلسه</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form id="create_syllabus" method="post"
                          action="{{ route('admin.syllabuses.update', [ 'syllabus' => $syllabus->id ]) }}"
                          enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="box-header"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="course">انتخاب دوره</label>
                                        <select type="text" class="form-control select2" id="course"
                                                name="course">
                                            @foreach($courses as $course)
                                                <option value="{{ $course->id }}"
                                                    {{ old('course', $syllabus->course_id) == $course->id ? 'selected':''}}>
                                                    {{ $course->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">عنوان</label>
                                        <input type="text" class="form-control" id="title"
                                               placeholder="عنوان" value="{{ old('title', $syllabus->title) }}"
                                               name="title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">نوع چلسه</label>
                                        <select type="text" class="form-control select2" id="type"
                                                name="type">
                                            @foreach($types as $value=>$key)
                                                <option value="{{ $key }}"
                                                    {{old('type', $syllabus->type) == $key ? 'selected':''}}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="typeBox1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="video_file_disk">نوع فایل</label>
                                            <select type="text" class="form-control select2" id="video_file_disk"
                                                    name="video_file_disk">
                                                @foreach($fileDisks as $value=>$key)
                                                    <option value="{{ $key }}"
                                                        {{old('video_file_disk', $syllabus->file_disk) == $key ? 'selected':''}}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 file_disk_type">
                                        <div class="form-group">
                                            <label for="video_url">آدرس ویدیو</label>
                                            <input type="text" class="form-control" placeholder="آدرس"
                                                   data-fileDisk="{{\App\Enums\FileDisk::URL}}"
                                                   id="video_url" name="video_url"
                                                   value="{{ old('video_url', $syllabus->file_disk == \App\Enums\FileDisk::URL ? $syllabus->video : '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 file_disk_type" style="display: none">
                                        <div class="form-group">
                                            <label for="video_file">انتخاب ویدیو</label>
                                            <label class="form-control">
                                                <span>{{ ($syllabus->video and $syllabus->file_disk == \App\Enums\FileDisk::Local) ? $syllabus->video : 'انتخاب کنید ...' }}</span>
                                                <input type="file" class="custom-file-input" accept="video/*"
                                                       data-fileDisk="{{\App\Enums\FileDisk::Local}}"
                                                       id="video_file" name="video_file" hidden>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="typeBox2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="audio_file_disk">نوع فایل</label>
                                            <select type="text" class="form-control select2" id="audio_file_disk"
                                                    name="audio_file_disk">
                                                @foreach($fileDisks as $value=>$key)
                                                    <option value="{{ $key }}"
                                                        {{old('audio_file_disk', $syllabus->file_disk) == $key ? 'selected':''}}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 file_disk_type">
                                        <div class="form-group">
                                            <label for="audio_url">آدرس فایل صوتی</label>
                                            <input type="text" class="form-control" placeholder="آدرس"
                                                   data-fileDisk="{{\App\Enums\FileDisk::URL}}"
                                                   id="audio_url" name="audio_url"
                                                   value="{{ old('audio_url', $syllabus->file_disk == \App\Enums\FileDisk::URL ? $syllabus->audio : '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 file_disk_type" style="display: none">
                                        <div class="form-group">
                                            <label for="audio_file">انتخاب فایل صوتی</label>
                                            <label class="form-control">
                                                <span>{{ ($syllabus->audio and $syllabus->file_disk == \App\Enums\FileDisk::Local) ? $syllabus->audio :'انتخاب کنید ...' }}</span>
                                                <input type="file" class="custom-file-input" accept="audio/*"
                                                       data-fileDisk="{{\App\Enums\FileDisk::Local}}"
                                                       name="audio_file" id="audio_file" value="{{ old('audio_file') }}"
                                                       hidden>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="typeBox3">
                                <label for="text">متن</label>
                                <div class="form-group">
                                    <textarea name="text" id="text">{{old('text', $syllabus->text)}}</textarea>
                                </div>
                            </div>
                            <div id="typeBox4">
                                <div id="questions_box">

                                    @foreach($syllabus->questions as $index => $question)
                                        <div class="questions_row" data-id="{{$index + 1}}">
                                            <div class="row">
                                                <div class="col-md-11">
                                                    <div class="form-group">
                                                        <label for="questions_titles_{{$index + 1}}">عنوان</label>
                                                        <textarea id="questions_titles_{{$index + 1}}"
                                                                  name="questions_titles[{{$index + 1}}]"
                                                                  required>{!! $question->title !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="remove_question_container">
                                                        <a href="javascript:void(0);"
                                                           class="btn btn-danger remove_question_btn">x</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="answer_{{$index + 1}}">پاسخ</label>
                                                        <select type="text" class="form-control"
                                                                id="answer_{{$index + 1}}" name="answer[{{$index + 1}}]" required>
                                                            <option disabled selected>انتخاب کنید</option>
                                                            <option
                                                                value="a" {{ $question->answer == 'a' ? 'selected' : ''}}>
                                                                گزینه 1
                                                            </option>
                                                            <option
                                                                value="b" {{ $question->answer == 'b' ? 'selected' : ''}}>
                                                                گزینه 2
                                                            </option>
                                                            <option
                                                                value="c" {{ $question->answer == 'c' ? 'selected' : ''}}>
                                                                گزینه 3
                                                            </option>
                                                            <option
                                                                value="d" {{ $question->answer == 'd' ? 'selected' : ''}}>
                                                                گزینه 4
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="answer_a_{{$index + 1}}">گزینه 1</label>
                                                        <textarea id="answer_a_{{$index + 1}}"
                                                                  name="answer_a[{{$index + 1}}]"
                                                                  required>{!! $question->a !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="answer_b_{{$index + 1}}">گزینه 2</label>
                                                        <textarea id="answer_b_{{$index + 1}}"
                                                                  name="answer_b[{{$index + 1}}]"
                                                                  required>{!! $question->b !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="answer_c_{{$index + 1}}">گزینه 3</label>
                                                        <textarea id="answer_c_{{$index + 1}}"
                                                                  name="answer_c[{{$index + 1}}]"
                                                                  required>{!! $question->c !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="answer_d_{{$index + 1}}">گزینه 4</label>
                                                        <textarea id="answer_d_{{$index + 1}}"
                                                                  name="answer_d[{{$index + 1}}]"
                                                                  required>{!! $question->d !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <a href="javascript:void(0);" class="btn btn-primary btn-block btn-sm mb-3"
                                   id="add_question_btn">
                                    افزودن سوال
                                </a>
                            </div>
                            <hr>

                            <a href="javascript:void(0);" class="btn btn-primary btn-sm mb-3" id="add_attachment_btn">افزودن
                                ضمیمه</a>
                            <div id="attachments_box">
                                @foreach( $syllabus->attachments() as $index=>$attachment)
                                    <div class="row attachments_row" data-id="{{$index}}">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="attachments_titles">عنوان</label>
                                                <input type="text" class="form-control"
                                                       name="attachments_titles[{{$index}}]"
                                                       value="{{ $attachment->title}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="attachments_files">انتخاب فایل</label>
                                                <label class="form-control">
                                                    <span>{{ $attachment->path}}</span>
                                                    <input type="file" class="custom-file-input" hidden
                                                           name="attachments_files[{{$index}}]">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="remove_attachment_container">
                                                <a href="javascript:void(0);"
                                                   class="btn btn-danger remove_attachment_btn">x</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <hr>
                            <h5>
                                SEO
                                <small>برای بهتر دیده شدن این بخش را کامل کنید</small>
                            </h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="meta_keywords">کلمات کلیدی</label>
                                        <input type="text" class="form-control" id="meta_keywords"
                                               placeholder="HTML, CSS, JavaScript"
                                               value="{{ old('meta_keywords') }}" name="meta_keywords">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="meta_description">توضیحات(بین ۱۳۵ تا ۱۶۰ کاراکتر باشد)</label>
                                    <textarea id="meta_description" name="meta_description" minlength="135"
                                              maxlength="160"
                                              class="form-control">{{old('meta_description')}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">ویرایش جلسه</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div id="attachment_sample" class="d-none">
        <div class="row attachments_row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="attachments_titles">عنوان</label>
                    <input type="text" class="form-control" id="attachments_titles"
                           placeholder="عنوان">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="attachments_files">انتخاب فایل</label>
                    <label class="form-control">
                        <span> انتخاب کنید ... </span>
                        <input type="file" class="custom-file-input"
                               id="attachments_files" hidden>
                    </label>
                </div>
            </div>
            <div class="col-md-1">
                <div class="remove_attachment_container">
                    <a href="javascript:void(0);" class="btn btn-danger remove_attachment_btn">x</a>
                </div>
            </div>
        </div>
    </div>

    <div id="question_sample" class="d-none">
        <div class="questions_row">
            <div class="row">
                <div class="col-md-11">
                    <div class="form-group">
                        <label for="questions_titles">عنوان</label>
                        <textarea id="questions_titles" required></textarea>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="remove_question_container">
                        <a href="javascript:void(0);" class="btn btn-danger remove_question_btn">x</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="answer">پاسخ</label>
                        <select type="text" class="form-control" id="answer" name="answer" required>
                            <option disabled selected>انتخاب کنید</option>
                            <option value="a">گزینه 1
                            </option>
                            <option value="b">گزینه 2
                            </option>
                            <option value="c">گزینه 3
                            </option>
                            <option value="d">گزینه 4
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="answer_a">گزینه 1</label>
                        <textarea id="answer_a" required></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="answer_b">گزینه 2</label>
                        <textarea id="answer_b" required></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="answer_c">گزینه 3</label>
                        <textarea id="answer_c" required></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="answer_d">گزینه 4</label>
                        <textarea id="answer_d" required></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('assets/admin/adminLTE/components/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-validation/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/admin/adminLTE/components/tinymce/tinymce.min.js') }}"></script>

    <script>
        let questionsCount = {{$syllabus->questions->count()}};

        function activeVideo() {
            $('#typeBox1').show();
            $('#typeBox2').hide();
            $('#typeBox3').hide();
            $('#typeBox4').hide();
            $('#typeBox1 input').prop('disabled', false);
            $('#typeBox2 input').prop('disabled', true);
            $('#typeBox3 textarea').prop('disabled', true);
            $('#typeBox4 input').prop('disabled', true);
        }

        function activeAudio() {
            $('#typeBox1').hide();
            $('#typeBox2').show();
            $('#typeBox3').hide();
            $('#typeBox4').hide();
            $('#typeBox1 input').prop('disabled', true);
            $('#typeBox2 input').prop('disabled', false);
            $('#typeBox3 textarea').prop('disabled', true);
            $('#typeBox4 input').prop('disabled', true);
        }

        function activeText() {
            $('#typeBox1').hide();
            $('#typeBox2').hide();
            $('#typeBox3').show();
            $('#typeBox4').hide();
            $('#typeBox1 input').prop('disabled', true);
            $('#typeBox2 input').prop('disabled', true);
            $('#typeBox3 textarea').prop('disabled', false);
            $('#typeBox4 input').prop('disabled', true);
        }

        function activeExam() {
            $('#typeBox1').hide();
            $('#typeBox2').hide();
            $('#typeBox3').hide();
            $('#typeBox4').show();
            $('#typeBox1 input').prop('disabled', true);
            $('#typeBox2 input').prop('disabled', true);
            $('#typeBox3 textarea').prop('disabled', true);
            $('#typeBox4 input').prop('disabled', false);
        }

        let form = $('#create_syllabus');
        let customRules = {
            title: "required",
            type: "required",
            text: "required"
        };
        let customMessages = {
            title: "عنوان الزامی است",
            type: "نوع جلسه الزامی است",
            video_url: "آدرس ویدیو الزامی است",
            video_file: "ویدیو الزامی است",
            audio_url: "آدرس فایل صوتی الزامی است",
            audio_file: "فایل صوتی الزامی است",
            text: "متن الزامی است",
        };

        let validator = form.validate({
            ignore: '',
            doNotHideMessage: true,
            errorElement: "span",
            errorClass: "help-block help-block-error",
            rules: customRules,
            messages: customMessages,
            errorPlacement: function (error, element) {
                if (element.attr('type') === 'file') {
                    error.insertAfter(element.parent('label'));
                } else {
                    error.insertAfter(element);
                }
            },
        });

        $(document).ready(function () {
            tinyMCE.init({
                selector: 'textarea#text',
                plugins: 'advlist autolink link lists preview table code pagebreak',
                menubar: false,
                language: 'fa',
                height: 300,
                relative_urls: false,
                toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link',
            });

            $('#type').on('change', function () {
                if (this.value === '1') {
                    activeVideo();
                } else if (this.value === '2') {
                    activeAudio();
                } else if (this.value === '3') {
                    activeText();
                } else if (this.value === '4') {
                    activeExam();
                }
            }).trigger('change');

            $('#video_file_disk').on('change', function () {
                if (this.value === '1') {
                    $('#video_url').closest('.file_disk_type').show();
                    $('#video_file').closest('.file_disk_type').hide();
                } else if (this.value === '2') {
                    $('#video_url').closest('.file_disk_type').hide();
                    $('#video_file').closest('.file_disk_type').show();
                }
            }).trigger('change');

            $('#audio_file_disk').on('change', function () {
                if (this.value === '1') {
                    $('#audio_url').closest('.file_disk_type').show();
                    $('#audio_file').closest('.file_disk_type').hide();
                } else if (this.value === '2') {
                    $('#audio_url').closest('.file_disk_type').hide();
                    $('#audio_file').closest('.file_disk_type').show();
                }
            }).trigger('change');

            form.on('submit', function (e) {
                tinyMCE.triggerSave();
                let valid = form.valid();

                if (!valid) {
                    validator.focusInvalid();
                    return false;
                }

                if ($('#type').val() === '4' && $('#questions_box .questions_row').length === 0) {
                    toastr.error('حداقل یک سوال اضافه کنید');
                    return false;
                }

                return true;
            })

            $('#add_attachment_btn').on('click', function () {
                let number = parseInt($('#attachments_box .attachments_row:last').attr('data-id') ?? 0) + 1;
                let html = $('#attachment_sample .attachments_row').clone().removeClass('d-none').attr('data-id', number);
                html.find('#attachments_titles').attr('name', 'attachments_titles[' + number + ']')
                    .attr('id', 'attachments_titles' + number)
                html.find('#attachments_files').attr('name', 'attachments_files[' + number + ']')
                    .attr('id', 'attachments_files' + number)
                html.appendTo('#attachments_box');
            })

            $('#add_question_btn').on('click', function () {
                let number = parseInt($('#questions_box .questions_row:last').attr('data-id') ?? 0) + 1;
                let html = $('#question_sample .questions_row').clone().removeClass('d-none').attr('data-id', number);
                html.find('#questions_titles').attr('id', 'questions_titles_' + number).attr('name', 'questions_titles[' + number + ']')
                html.find('#answer').attr('id', 'answer_' + number).attr('name', 'answer[' + number + ']')
                html.find('#answer_a').attr('id', 'answer_a_' + number).attr('name', 'answer_a[' + number + ']')
                html.find('#answer_b').attr('id', 'answer_b_' + number).attr('name', 'answer_b[' + number + ']')
                html.find('#answer_c').attr('id', 'answer_c_' + number).attr('name', 'answer_c[' + number + ']')
                html.find('#answer_d').attr('id', 'answer_d_' + number).attr('name', 'answer_d[' + number + ']')
                html.appendTo('#questions_box');

                tinymce.init({
                    selector: 'textarea#questions_titles_' + number,
                    plugins: 'advlist autolink link lists preview table code pagebreak formula image',
                    menubar: false,
                    language: 'fa',
                    height: 100,
                    relative_urls: false,
                    toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link image | formula',
                });
                tinymce.init({
                    selector: 'textarea#answer_a_' + number,
                    plugins: 'advlist autolink link lists preview table code pagebreak formula image',
                    menubar: false,
                    language: 'fa',
                    height: 70,
                    relative_urls: false,
                    toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link image | formula',
                });
                tinymce.init({
                    selector: 'textarea#answer_b_' + number,
                    plugins: 'advlist autolink link lists preview table code pagebreak formula image',
                    menubar: false,
                    language: 'fa',
                    height: 70,
                    relative_urls: false,
                    toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link image | formula',
                });
                tinymce.init({
                    selector: 'textarea#answer_c_' + number,
                    plugins: 'advlist autolink link lists preview table code pagebreak formula image',
                    menubar: false,
                    language: 'fa',
                    height: 70,
                    relative_urls: false,
                    toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link image | formula',
                });
                tinymce.init({
                    selector: 'textarea#answer_d_' + number,
                    plugins: 'advlist autolink link lists preview table code pagebreak formula image',
                    menubar: false,
                    language: 'fa',
                    height: 70,
                    relative_urls: false,
                    toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link image | formula',
                });
            })

            let i;
            for (i = 1; i <= questionsCount; i++) {
                tinymce.init({
                    selector: 'textarea#questions_titles_' + i,
                    plugins: 'advlist autolink link lists preview table code pagebreak formula image',
                    menubar: false,
                    language: 'fa',
                    height: 100,
                    relative_urls: false,
                    toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link image | formula',
                });
                tinymce.init({
                    selector: 'textarea#answer_a_' + i,
                    plugins: 'advlist autolink link lists preview table code pagebreak formula image',
                    menubar: false,
                    language: 'fa',
                    height: 70,
                    relative_urls: false,
                    toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link image | formula',
                });
                tinymce.init({
                    selector: 'textarea#answer_b_' + i,
                    plugins: 'advlist autolink link lists preview table code pagebreak formula image',
                    menubar: false,
                    language: 'fa',
                    height: 70,
                    relative_urls: false,
                    toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link image | formula',
                });
                tinymce.init({
                    selector: 'textarea#answer_c_' + i,
                    plugins: 'advlist autolink link lists preview table code pagebreak formula image',
                    menubar: false,
                    language: 'fa',
                    height: 70,
                    relative_urls: false,
                    toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link image | formula',
                });
                tinymce.init({
                    selector: 'textarea#answer_d_' + i,
                    plugins: 'advlist autolink link lists preview table code pagebreak formula image',
                    menubar: false,
                    language: 'fa',
                    height: 70,
                    relative_urls: false,
                    toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link image | formula',
                });
            }

            $('body').on('click', '.remove_attachment_btn', function (e) {
                $(this).parents('.attachments_row').remove();
            })

        });
    </script>
@endsection
