@extends('pages.admin.layout.base')

@section('title', 'خانه')

@section( 'course.category', 'active menu-open')
@section( 'course.category1', 'active')

@section('style')
@endsection

@section('header')
    <section class="content-header">
        <h1>
            ویرایش دسته بندی
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">دسته بندی ها</a></li>
            <li class="active">ویرایش دسته بندی</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form method="post" action="{{ route('admin.course.categories.update', ['category' => $category->id]) }}"
                          enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="box-header"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">نام</label>
                                        <input type="text" class="form-control" id="name" placeholder="نام"
                                               value="{{ old('name', $category->name) }}" name="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="parent">والد</label>
                                        <select type="text" class="form-control select2" id="parent" name="parent">
                                            <option value="">بدون والد (دسته اصلی)</option>
                                            @foreach($mainCategories as $mainCategory)
                                                <option value="{{ $mainCategory->id }}"
                                                    {{old('parent', $category->parent_id) == $mainCategory->id ? 'selected':''}}>
                                                    {{ $mainCategory->name }}
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
                                        <label class="form-control">
                                            <span>{{ $category->image ?? 'انتخاب کنید ...' }}</span>
                                            <input type="file" class="custom-file-input" accept="image/*"
                                                   id="image" name="image" hidden>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="description">توضیحات </label>
                                    <textarea id="description" name="description"
                                              class="form-control">{{old('description', $category->description) }}</textarea>
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

@section('js')
@endsection
