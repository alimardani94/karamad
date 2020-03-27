@extends('admin.layout.base')

@section('title', 'خانه')
@section('course', 'active menu-open')
@section('course2', 'active')

@section('header')
    <section class="content-header">
        <h1>
            افزودن دوره جدید
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">دوره ها</a></li>
            <li class="active">افزودن دوره</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form method="post" action="{{route('admin.courses.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-header"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">عنوان</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                               value="{{old('title')}}" placeholder="عنوان">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">دسته بندی</label>
                                        <select type="text" class="form-control select2" id="category"
                                                name="category">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{old('category') == $category->id ? 'selected':''}}>
                                                    {{ $category->parent->name }} - {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="instructor">مدرس</label>
                                        <select type="text" class="form-control select2" id="instructor"
                                                name="instructor">
                                            @foreach($instructors as $instructor)
                                                <option value="{{ $instructor->id }}"
                                                    {{old('instructor') == $instructor->id ? 'selected':''}}>
                                                    {{ $instructor->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="summary">خلاصه</label>
                                    <textarea id="summary" name="summary"
                                              class="form-control">{{old('summary')}}</textarea>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="description">توضیحات </label>
                                    <textarea id="description" name="description"
                                              style="width: 100%; height: 200px; border: 1px solid #dddddd; padding: 10px;"
                                              class="form-control">{{old('description')}}</textarea>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="thumbnail">تصویر بند انگشتی</label>
                                        <input type="file" id="thumbnail" name="thumbnail" accept="image/*"
                                               value="{{old('thumbnail')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">تصویر</label>
                                        <input type="file" id="image" name="image" accept="image/*"
                                               value="{{old('image')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <hr>
                                <div class="col-md-12">
                                    <p>در صورتی که دوره رایگان نیست این قسمت را تکمیل فرمایید</p>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">قیمت</label>
                                        <input type="text" class="form-control" id="price" placeholder="قیمت"
                                               value="{{old('price')}}" name="price">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discount">تخفیف</label>
                                        <input type="text" class="form-control" id="discount" placeholder="تخفیف"
                                               value="{{old('discount')}}" name="discount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">افزودن دوره جدید</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('assets/admin/adminLTE/components/tinymce/tinymce.min.js')}}"></script>
    <script>
        tinymce.init({
            selector: 'textarea#description',
            plugins: 'advlist autolink link lists preview table code pagebreak',
            menubar: false,
            language: 'fa',
            height: 300,
            relative_urls: false,
            toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link',
        });
    </script>
@endsection
