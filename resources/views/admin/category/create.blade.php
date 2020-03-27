@extends('admin.layout.base')

@section('title', 'خانه')
@section('category', 'active menu-open')
@section('category2', 'active')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/vendor/select2/css/select2.min.css')}}">
@endsection

@section('header')
    <section class="content-header">
        <h1>
            افزودن دسته بندی جدید
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">دسته بندی ها</a></li>
            <li class="active">افزودن دسته بندی</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form method="post" action="{{route('admin.categories.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-header"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">نام</label>
                                        <input type="text" class="form-control" id="name" placeholder="نام"
                                               value="{{old('name')}}" name="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="parent">والد</label>
                                        <select type="text" class="form-control select2" id="parent" name="parent">
                                            <option value="">بدون والد (دسته اصلی)</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{old('parent') == $category->id ? 'selected':''}}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">تصویر</label>
                                        <input type="file" id="image" name="image" accept="image/*" value="{{old('image')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="description">توضیحات </label>
                                    <textarea id="description" name="description" class="form-control">{{old('description')}}</textarea>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">افزودن دسته بندی جدید</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{asset('assets/vendor/select2/js/select2.full.min.js')}}"></script>
@endsection
