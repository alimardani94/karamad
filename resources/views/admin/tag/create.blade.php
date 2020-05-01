@extends('admin.layout.base')

@section('title', 'خانه')
@section('post', 'active menu-open')
@section('post3', 'active')

@section('style')
@endsection

@section('header')
    <section class="content-header">
        <h1>
            افزودن برچسب جدید
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">برچسب ها</a></li>
            <li class="active">افزودن برچسب</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form method="post" action="{{route('admin.tags.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-header"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">نام</label>
                                        <input type="text" class="form-control" id="name" placeholder="نام"
                                               value="{{old('name')}}" name="name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">افزودن برچسب جدید</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>تاریخ ایجاد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $tag)
                                <tr>
                                    <td>{{$tag->name}}</td>
                                    <td>{{jDate($tag->created_at, 'dd MMMM yyyy - HH:mm')}}</td>
                                    <td>
                                        <a type="button" class="btn btn-block btn-primary btn-xs">ویرایش برچسب
                                        </a>
                                        <a type="button" class="btn btn-block btn-danger btn-xs">حذف برچسب</a>
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

@section('js')
@endsection
