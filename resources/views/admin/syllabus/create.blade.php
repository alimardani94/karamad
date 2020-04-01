@extends('admin.layout.base')

@section('title', 'خانه')
@section('syllabus', 'active menu-open')
@section('syllabus2', 'active')

@section('style')

@endsection

@section('header')
    <section class="content-header">
        <h1>
            افزودن جلسه جدید
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
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
                    <form id="create_syllabus" method="post" action="{{route('admin.syllabuses.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="box-header"></div>
                        <div class="box-body">
                            @if(!$course)
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="course">انتخاب دوره</label>
                                            <select type="text" class="form-control select2" id="course"
                                                    name="course">
                                                @foreach($courses as $course)
                                                    <option value="{{ $course->id }}"
                                                        {{old('course') == $course->id ? 'selected':''}}>
                                                        {{ $course->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <label>
                                    <input name="course" value="{{$course->id}}" hidden>
                                </label>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">عنوان</label>
                                        <input type="text" class="form-control" id="title"
                                               placeholder="عنوان" value="{{old('title')}}"
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
                                                    {{old('type') == $key ? 'selected':''}}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="description">توضیحات </label>
                                    <div class="form-group">
                                    <textarea id="description" name="description"
                                              class="form-control">{{old('description')}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div id="typeBox1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="video_file_disk">نوع فایل</label>
                                            <select type="text" class="form-control select2" id="video_file_disk"
                                                    name="video_file_disk">
                                                @foreach($fileDisks as $value=>$key)
                                                    <option value="{{ $key }}"
                                                        {{old('video_file_disk') == $key ? 'selected':''}}>
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
                                                   id="video_url" name="video_url" value="{{old('video_url')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 file_disk_type" style="display: none">
                                        <div class="form-group">
                                            <label for="video_file">انتخاب ویدیو</label>
                                            <label class="form-control">
                                                <span> انتخاب کنید ... </span>
                                                <input type="file" class="custom-file-input" accept="video/*"
                                                       data-fileDisk="{{\App\Enums\FileDisk::Local}}"
                                                       id="video_file" name="video_file" value="{{old('video_file')}}"
                                                       hidden>
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
                                                        {{old('audio_file_disk') == $key ? 'selected':''}}>
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
                                                   id="audio_url" name="audio_url" value="{{old('audio_url')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 file_disk_type" style="display: none">
                                        <div class="form-group">
                                            <label for="audio_file">انتخاب فایل صوتی</label>
                                            <label class="form-control">
                                                <span> انتخاب کنید ... </span>
                                                <input type="file" class="custom-file-input" accept="audio/*"
                                                       data-fileDisk="{{\App\Enums\FileDisk::Local}}"
                                                       name="audio_file" id="audio_file" value="{{old('audio_file')}}"
                                                       hidden>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="typeBox3">
                                <label for="text">متن</label>
                                <div class="form-group">
                                    <textarea name="text" id="text"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">افزودن جلسه</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('assets/admin/adminLTE/components/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-validation/jquery.validate.js')}}"></script>
    <script src="{{ asset('assets/admin/adminLTE/components/tinymce/tinymce.min.js')}}"></script>

    <script>
        function activeVideo() {
            $('#typeBox1').show();
            $('#typeBox2').hide();
            $('#typeBox3').hide();
            $('#typeBox1 input').prop('disabled', false);
            $('#typeBox2 input').prop('disabled', true);
            $('#typeBox3 textarea').prop('disabled', true);
        }

        function activeAudio() {
            $('#typeBox1').hide();
            $('#typeBox2').show();
            $('#typeBox3').hide();
            $('#typeBox1 input').prop('disabled', true);
            $('#typeBox2 input').prop('disabled', false);
            $('#typeBox3 textarea').prop('disabled', true);
        }

        function activeText() {
            $('#typeBox1').hide();
            $('#typeBox2').hide();
            $('#typeBox3').show();
            $('#typeBox1 input').prop('disabled', true);
            $('#typeBox2 input').prop('disabled', true);
            $('#typeBox3 textarea').prop('disabled', false);
        }

        let form = $('#create_syllabus');
        let customRules = {
            title: "required",
            type: "required",
            video_url: "syllabusType",
            video_file: "syllabusType",
            audio_url: "syllabusType",
            audio_file: "syllabusType",
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

        $.validator.addMethod("syllabusType", function (value, element) {
            let elemFileDisk = $(element).attr('data-fileDisk') ?? '';

            switch ($('#type').val()) {
                case '1':
                    return !($('#video_file_disk').val() === elemFileDisk && value === '');
                case '2':
                    return !($('#audio_file_disk').val() === elemFileDisk && value === '');
            }
            return true;
        });

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
            });

            $('#audio_file_disk').on('change', function () {
                if (this.value === '1') {
                    $('#audio_url').closest('.file_disk_type').show();
                    $('#audio_file').closest('.file_disk_type').hide();
                } else if (this.value === '2') {
                    $('#audio_url').closest('.file_disk_type').hide();
                    $('#audio_file').closest('.file_disk_type').show();
                }
            });

            form.on('submit', function (e) {
                tinyMCE.triggerSave();
                let valid = form.valid();
                if (!valid) {
                    validator.focusInvalid();
                    return false;
                }
                return true;
            })

        });
    </script>
@endsection
