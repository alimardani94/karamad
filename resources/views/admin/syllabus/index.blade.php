@extends('admin.layout.base')

@section('title', 'خانه')
@section('syllabus', 'active menu-open')
@section('syllabus1', 'active')

@section('header')
    <section class="content-header">
        <h1>
            جلسه ها <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">جلسه ها</a></li>
            <li class="active">لیست جلسه ها</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">لیست جلسه ها</h3>
                        <a href="{{route('admin.syllabuses.create')}}" class="btn btn-primary btn-flat pull-left">افزودن
                            جلسه جدید</a>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(syllabuses as $syllabus)
                                <tr>
                                    <td>{{$syllabus->title}}</td>
                                    <td>
                                        <a type="button" class="btn btn-block btn-primary btn-xs">ویرایش جلسه
                                        </a>
                                        <a type="button" class="btn btn-block btn-danger btn-xs">حذف جلسه</a>
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
