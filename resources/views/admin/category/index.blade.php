@extends('admin.layout.base')

@section('title', 'خانه')
@section('category', 'active menu-open')
@section('category1', 'active')

@section('header')
    <section class="content-header">
        <h1>
            دسته بندی ها <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">دسته بندی ها</a></li>
            <li class="active">لیست دسته بندی ها</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">لیست دسته بندی ها</h3>
                        <a href="{{route('admin.categories.create')}}" class="btn btn-primary btn-flat pull-left">افزودن
                            دسته بندی جدید</a>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>نام</th>
                                <th>والد</th>
                                <th>تاریخ ایجاد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->name}}</td>
                                    <td>{{ $category->parent ? $category->parent->name : 'ندارد (دسته اصلی)' }}</td>
                                    <td>{{jDate($category->created_at, 'dd MMMM yyyy - HH:mm')}}</td>
                                    <td>
                                        <a type="button" class="btn btn-block btn-primary btn-xs">ویرایش دسته بندی
                                        </a>
                                        <a type="button" class="btn btn-block btn-danger btn-xs">حذف دسته بندی</a>
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