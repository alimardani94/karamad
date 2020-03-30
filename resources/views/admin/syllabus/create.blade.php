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

                            <section>
                                <div id="form_wizard">
                                    <ul class="nav nav-tabs nav-justified steps">
                                        <li>
                                            <a href="#tab1" data-toggle="tab" class="step">
                                                <span class="number"> 1 </span> <span class="desc"> کلیات </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab2" data-toggle="tab" class="step">
                                                <span class="number"> 2 </span> <span class="desc"> افزودن جلسه </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab2" data-toggle="tab" class="step">
                                                <span class="number"> 3 </span> <span class="desc"> مشخصات </span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div id="bar" class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                             aria-valuemax="100" style="width: 0%;"></div>
                                    </div>

                                    <div class="tab-content">
                                        <div class="tab-pane" id="tab1">
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
                                                    <input name="course" value="{{$course}}" hidden>
                                                </label>
                                            @endif
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="title">عنوان</label>
                                                        <input type="text" class="form-control" id="title"
                                                               placeholder="عنوان"
                                                               value="{{old('title')}}" name="title">
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
                                                    <textarea id="description" name="description"
                                                              class="form-control">{{old('description')}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            <div id="video" style="">

                                            </div>
                                            <div id="audio">
                                                3
                                            </div>
                                            <div id="text">
                                                5
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab3">
                                            3
                                        </div>
                                        <ul class="pager wizard">
                                            <li class="previous first" style="display:none;"><a href="#">ابتدا</a></li>
                                            <li class="previous"><a href="#">قبلی</a></li>
                                            <li class="next last" style="display:none;"><a href="#">انتها</a></li>
                                            <li class="next"><a href="#">بعدی</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </section>

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
    <script src="{{ asset('assets/vendor/jquery bootstrap wizard/jquery.bootstrap.wizard.min.js')}}"></script>
    <script src="{{asset('assets/vendor/dropzone-5.7.0/min/dropzone.min.js')}}"></script>

    <script>
        let form = $('#create_syllabus');
        let customRules = {
            title: "required",
            type: "required",
        };

        let customMessages = {
            title: "عنوان الزامی است",
            type: "نوع جلسه الزامی است",
        };

        var validator = form.validate({
            doNotHideMessage: true,
            errorElement: "span",
            errorClass: "help-block help-block-error",
            rules: customRules,
            messages: customMessages,
        });

        $(document).ready(function () {
            $('#form_wizard').bootstrapWizard({
                onTabClick: function (tab, navigation, index) {
                    // return false;
                    return true;
                },
                onNext: function (tab, navigation, index) {
                    var valid = form.valid();
                    if (!valid) {
                        validator.focusInvalid();
                        return false;
                    }
                },
                onTabShow: function (tab, navigation, index) {
                    //update progress-bar
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var percent = (current / total) * 100;
                    var progressBar = $('#bar');

                    progressBar.find(".progress-bar").css({
                        width: percent + "%"
                    });


                }
            });

           
        });
    </script>
@endsection
