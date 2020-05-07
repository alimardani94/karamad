@extends('admin.layout.base')

@section('title', 'خانه')
@section('admin', 'active menu-open')
@section('admin1', 'active')

@section('header')
    <section class="content-header">
        <h1>
            مدیران <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">مدیران</a></li>
            <li class="active">لیست مدیران</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">لیست مدیران</h3>
                        <a href="{{route('admin.admins.create')}}" class="btn btn-primary btn-flat pull-left">
                            افزودن مدیر جدید
                        </a>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>نام</th>
                                <th>تاریخ ایجاد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td>{{$admin->user->full_name}}</td>
                                    <td>{{jDate($admin->created_at, 'dd MMMM yyyy - HH:mm')}}</td>
                                    <td>
                                        <a type="button" class="btn btn-block btn-primary btn-xs">ویرایش مدیر
                                        </a>
                                        <a type="button" class="btn btn-block btn-danger btn-xs">حذف مدیر</a>
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
