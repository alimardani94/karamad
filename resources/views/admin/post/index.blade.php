@extends('admin.layout.base')

@section('title', 'خانه')
@section('post', 'active menu-open')
@section('post1', 'active')

@section('header')
    <section class="content-header">
        <h1>
            مجله ها <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">مجله ها</a></li>
            <li class="active">لیست مجله ها</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">لیست مجله ها</h3>
                        <a href="{{route('admin.posts.create')}}" class="btn btn-primary btn-flat pull-left">افزودن
                            مجله جدید</a>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>برچسب ها</th>
                                <th>نویسنده</th>
                                <th>تاریخ ایجاد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td>
                                        @foreach($post->tagsArray() as $tag)
                                            <li>{{$tag}}</li>
                                        @endforeach
                                    </td>
                                    <td>{{ $post->author->full_name }}</td>
                                    <td>{{jDate($post->created_at, 'dd MMMM yyyy - HH:mm')}}</td>
                                    <td>
                                        <a type="button" class="btn btn-block btn-primary btn-xs">ویرایش مجله
                                        </a>
                                        <a type="button" class="btn btn-block btn-danger btn-xs">حذف مجله</a>
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
