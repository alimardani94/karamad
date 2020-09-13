@extends('admin.layout.base')

@section('title', 'خانه')
@section('post', 'active menu-open')
@section('post2', 'active')

@section('style')
@endsection

@section('header')
    <section class="content-header">
        <h1>
            افزودن مقاله جدید
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">مقاله ها</a></li>
            <li class="active">افزودن مقاله</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form method="post" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-header"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">عنوان</label>
                                        <input type="text" class="form-control" id="title" placeholder="عنوان"
                                               value="{{ old('title') }}" name="title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tags">برچسب ها</label>
                                        <select type="text" class="form-control select2" id="tags" name="tags[]" multiple="multiple"  style="width: 100%;">
                                            @foreach($tags as $tag)
                                                <option value="{{ $tag->id }}"
                                                    {{in_array($tag->id, old('tags', [])) ? 'selected':''}}>
                                                    {{ $tag->name }}
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
                                            <span> انتخاب کنید ... </span>
                                            <input type="file" class="custom-file-input" accept="image/*"
                                                   id="image" name="image" value="{{ old('image') }}"
                                                   hidden>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="content">محتوا </label>
                                    <textarea id="content" name="content"
                                              style="width: 100%; height: 210px; border: 1px solid #dddddd; padding: 10px;"
                                              class="form-control">{!! old('content') !!}</textarea>
                                </div>
                            </div>

                            <hr>
                            <h5>
                                SEO
                                <small>برای بهتر دیده شدن این بخش را کامل کنید</small>
                            </h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="meta_keywords">کلمات کلیدی</label>
                                        <input type="text" class="form-control" id="meta_keywords" placeholder="HTML, CSS, JavaScript"
                                               value="{{ old('meta_keywords')}}" name="meta_keywords">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="meta_description">توضیحات(بین ۱۳۵ تا ۱۶۰ کاراکتر باشد)</label>
                                    <textarea id="meta_description" name="meta_description" minlength="135" maxlength="160"
                                              class="form-control">{{old('meta_description')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">افزودن مقاله جدید</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('js')
    <script type="text/javascript" src="{{ asset('assets/admin/adminLTE/components/ckeditor/ckeditor.js')}}"></script>

    <script>
        CKEDITOR.config.contentsLangDirection = 'rtl';
        CKEDITOR.config.language = 'fa';
        CKEDITOR.replace('content');
    </script>
@endsection
