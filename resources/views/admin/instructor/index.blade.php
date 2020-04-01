@extends('admin.layout.base')

@section('title', 'خانه')
@section('instructor', 'active menu-open')
@section('instructor1', 'active')

@section('header')
    <section class="content-header">
        <h1>
            مدرسان <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">مدرسان</a></li>
            <li class="active">لیست مدرسان</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">لیست مدرسان</h3>
                        <a href="{{route('admin.instructors.create')}}" class="btn btn-primary btn-flat pull-left">افزودن
                            مدرس جدید</a>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>نام</th>
                                <th>توضیحات</th>
                                <th>نوع</th>
                                <th>تاریخ ایجاد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($instructors as $instructor)
                                <tr>
                                    <td>{{$instructor->name}}</td>
                                    <td>{{substr($instructor->about,0,200)}}</td>
                                    <td>{{$instructor->type}}</td>
                                    <td>{{jDate($instructor->created_at, 'dd MMMM yyyy - HH:mm')}}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
