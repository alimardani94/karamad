@extends('admin.layout.base')

@section('title', 'خانه')
@section('admin', 'active menu-open')
@section('admin2', 'active')

@section('style')
@endsection

@section('header')
    <section class="content-header">
        <h1>
            افزودن مدیر جدید
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">مدیران</a></li>
            <li class="active">افزودن مدیر</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form method="post" action="{{ route('admin.admins.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-header"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">نام</label>
                                        <input type="text" class="form-control" id="name" placeholder="نام"
                                               value="{{ old('name')}}" name="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="surname">نام خانوادگی</label>
                                        <input type="text" class="form-control" id="surname" placeholder="نام خانوادگی"
                                               value="{{ old('surname')}}" name="surname">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">ایمیل</label>
                                        <input type="text" class="form-control" id="email" placeholder="ایمیل"
                                               value="{{ old('email')}}" name="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cell">موبایل</label>
                                        <input type="text" class="form-control" id="cell" placeholder="موبایل"
                                               value="{{ old('cell')}}" name="cell">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">افزودن مدیر جدید</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
@endsection
