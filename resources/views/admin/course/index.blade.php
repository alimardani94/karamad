@extends('admin.layout.base')

@section('title', 'خانه')
@section('course', 'active menu-open')
@section('course1', 'active')

@section('header')
    <section class="content-header">
        <h1>
            دوره ها <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">دوره ها</a></li>
            <li class="active">لیست دوره ها</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">لیست دوره ها</h3>
                        <a href="{{route('admin.courses.create')}}" class="btn btn-primary btn-flat pull-left">افزودن
                            دوره جدید</a>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>خلاصه</th>
                                <th>مدرس</th>
                                <th>دسته</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{$course->title}}</td>
                                    <td>{{substr($course->summary,0,200)}}</td>
                                    <td>{{$course->instructor->name}}</td>
                                    <td>{{$course->category->name}}</td>
                                    <td>
                                        <button type="button" class="btn btn-block btn-default btn-xs">افزودن جلسه</button>
                                        <button type="button" class="btn btn-block btn-primary btn-xs">ویرایش دوره</button>
                                        <button type="button" class="btn btn-block btn-danger btn-xs">حذف دوره</button>
                                    </td>
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
