@extends('admin.layout.base')

@section('title', 'خانه')
@section('exam', 'active menu-open')
@section('exam2', 'active')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/persian-datepicker/css/persian-datepicker.min.css') }}"/>
@endsection

@section('header')
    <section class="content-header">
        <h1>
            افزودن آزمون جدید
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">آزمون ها</a></li>
            <li class="active">افزودن آزمون</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form method="post" action="{{route('admin.exams.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-header"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">عنوان</label>
                                        <input type="text" class="form-control" id="title" placeholder="عنوان"
                                               value="{{old('title')}}" name="title">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_time">ساعت شروع</label>
                                        <input type="text" class="form-control" id="start_time" placeholder="ساعت شروع"
                                               value="{{old('start_time')}}" name="start_time" autocomplete="false"
                                               style="direction: ltr" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="time">زمان امتحان</label>
                                        <input type="text" class="form-control" id="time" placeholder="زمان امتحان"
                                               value="{{old('time', '02:30:00')}}" name="time" autocomplete="false"
                                               style="direction: ltr" readonly>
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

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">افزودن آزمون جدید</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{asset('assets/vendor/persian-date/persian-date.min.js')}}"></script>
    <script src="{{asset('assets/vendor/persian-datepicker/js/persian-datepicker.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $("#start_time").pDatepicker({
                initialValue: true,
                format: 'YYYY/MM/DD HH:mm:ss',
                timePicker: {
                    enabled: true,
                    step: 1,
                }
            });

            $("#time").pDatepicker({
                onlyTimePicker : true,
                initialValue: true,
                format: 'HH:mm:ss',
            });
        });
    </script>
@endsection
