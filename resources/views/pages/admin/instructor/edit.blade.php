@extends('pages.admin.layout.base')

@section('title', 'خانه')
@section('instructor', 'active menu-open')
@section('instructor1', 'active')

@section('header')
    <section class="content-header">
        <h1>
            ویرایش مدرس
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">مدرسان</a></li>
            <li class="active">ویرایش مدرس</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form method="post" action="{{ route('admin.course.instructors.update', ['instructor' => $instructor]) }}">
                        @method('PUT')
                        @csrf
                        <div class="box-header"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">نام</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{ old('name', $instructor->name) }}" placeholder="نام">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">
                                            لقب / سمت / شغل ( برای مثال استاد دانشگاه)
                                        </label>
                                        <input type="text" class="form-control" id="title" name="title"
                                               value="{{ old('title', $instructor->title) }}" placeholder="عنوان">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="about">توضیحات </label>
                                    <textarea id="about" name="about" class="form-control">{{old('about', $instructor->about) }}</textarea>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">ویرایش</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
