@extends('admin.layout.base')

@section('title', 'خانه')
@section('syllabus', 'active menu-open')
@section('syllabus2', 'active')

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
                                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                    </div>

                                    <div class="tab-content">
                                        <div class="tab-pane" id="tab1">
                                            1
                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            2
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

    <script>
        let form = $('#create_syllabus');

        var validator = form.validate({
            doNotHideMessage: true,
            errorElement: "span",
            // errorPlacement: function (error, element) {
            //     //for touch spin
            //     if (element.hasClass("have_error_placement")) {
            //         error.appendTo(element.parent(".input-group").siblings(".error"));
            //     } else {
            //         error.appendTo(element.parent());
            //     }
            // },

            errorClass: "help-block help-block-error",
            rules: [],
            messages: [],
            // highlight: function (element, errorClass) {
            //     $(element).closest(".form-group").removeClass("has-success").addClass("has-error");
            // },
            // unhighlight: function (element, errorClass) {
            //     $(element).closest(".form-group").removeClass("has-error");
            // },
        });

        $(document).ready(function() {
            $('#form_wizard').bootstrapWizard({
                onTabClick: function (tab, navigation, index) {
                    return false;
                    // return true;
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
