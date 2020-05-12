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
                                <th>مدرس</th>
                                <th>دسته</th>
                                <th>تعداد جلسات</th>
                                <th>خلاصه</th>
                                <th>تاریخ ایجاد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{$course->title}}</td>
                                    <td>{{$course->instructor->name ?? ''}}</td>
                                    <td>{{$course->category->name ?? ''}}</td>
                                    <td>{{$course->syllabuses()->count()}}</td>
                                    <td>{{substr($course->summary,0,200)}}</td>
                                    <td>{{jDate($course->created_at, 'dd MMMM yyyy - HH:mm')}}</td>
                                    <td>
                                        <a href="{{route('admin.syllabuses.create', ['course' => $course->id])}}"
                                           type="button" class="btn btn-block btn-default btn-xs">افزودن جلسه</a>
                                        <a href="{{route('admin.syllabuses.index', ['course' => $course->id])}}"
                                           type="button" class="btn btn-block btn-info btn-xs">لیست جلسات</a>
                                        <a type="button" class="btn btn-block btn-primary btn-xs">ویرایش دوره
                                        </a>
                                        <a type="button" class="btn btn-block btn-danger btn-xs">حذف دوره</a>
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
