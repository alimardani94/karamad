@extends('admin.layout.base')

@section('title', 'خانه')

@section('header')
    <section class="content-header">
        <h1>
            افزودن مدرس جدید
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">مدرسان</a></li>
            <li class="active">افزودن مدرس</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form>
                        <div class="box-header"></div>
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">نام</label>
                                        <input type="text" class="form-control" id="name" placeholder="نام">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="surname">نام خانوادگی</label>
                                        <input type="text" class="form-control" id="surname" placeholder="نام خانوادگی">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">
                                            لقب / سمت / شغل ( برای مثال استاد دانشگاه)
                                        </label>
                                        <input type="text" class="form-control" id="title" placeholder="عنوان">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="about">توضیحات </label>
                                    <textarea id="about" class="form-control"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">افزودن مدرس جدید</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
