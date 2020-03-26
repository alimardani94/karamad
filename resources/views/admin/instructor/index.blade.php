@extends('admin.layout.base')

@section('title', 'خانه')

@section('header')
    <section class="content-header">
        <h1>
            مدرسان <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">مدرسان</a></li>
            <li class="active">لیست مدرسان</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">لیست مدرسان</h3>
                        <a href="{{route('admin.instructors.create')}}" class="btn btn-primary btn-flat pull-left">افزودن مدرس جدید</a>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>موتور رندر</th>
                                <th>مرورگر</th>
                                <th>سیستم عامل</th>
                                <th>ورژن</th>
                                <th>امتیاز</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Trident</td>
                                <td>Internet
                                    Explorer 4.0
                                </td>
                                <td>Win 95+</td>
                                <td> 4</td>
                                <td>X</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
