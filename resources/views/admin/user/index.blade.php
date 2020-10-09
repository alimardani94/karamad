@extends('admin.layout.base')

@section('title', 'لیست کاربران')
@section('user', 'active menu-open')
@section('user1', 'active')

@section('header')
    <section class="content-header">
        <h1>
            کاربران <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">کاربران</a></li>
            <li class="active">لیست کاربران</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">لیست کاربران</h3>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>نام</th>
                                <th>تلفن</th>
                                <th>ایمیل</th>
                                <th>تاریخ ایجاد</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.users.show', $user->id) }}">
                                            {{ $user->full_name}}
                                        </a>
                                    </td>
                                    <td>{{ $user->cell}}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>{{jDate($user->created_at, 'dd MMMM yyyy - HH:mm')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
