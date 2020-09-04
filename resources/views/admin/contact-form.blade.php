@extends('admin.layout.base')

@section('title', 'پیام ها')
@section('post', 'active menu-open')
@section('post1', 'active')

@section('header')
    <section class="content-header">
        <h1>
            پیام ها <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">پیام ها</a></li>
            <li class="active">لیست پیام ها</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">پیام ها</h3>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>نام</th>
                                <th>ایمیل</th>
                                <th>شماره</th>
                                <th>متن</th>
                                <th>تاریخ ایجاد</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($messages as $message)
                                <tr>
                                    <td>{{$message->name}}</td>
                                    <td>{{$message->email}}</td>
                                    <td>{{$message->cell}}</td>
                                    <td>{{$message->body}}</td>
                                    <td>{{jDate($message->created_at, 'dd MMMM yyyy - HH:mm')}}</td>
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
