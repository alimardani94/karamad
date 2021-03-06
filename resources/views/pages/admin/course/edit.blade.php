@extends('pages.admin.layout.base')

@section('title', 'خانه')
@section('course', 'active menu-open')
@section('course2', 'active')

@section('header')
    <section class="content-header">
        <h1>
            ویرایش دوره

        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">دوره ها</a></li>
            <li class="active">
                ویرایش دوره
                <span>{{ $course->title}}</span>
            </li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form method="post" action="{{ route('admin.course.courses.update', ['course' => $course->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="box-header"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">عنوان</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                               value="{{ old('title', $course->title) }}" placeholder="عنوان">
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
                                                    {{old('category', $course->category_id) == $category->id ? 'selected':''}}>
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
                                                    {{old('instructor', $course->instructor_id) == $instructor->id ? 'selected':''}}>
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
                                    <textarea id="summary" name="summary" class="form-control">{{old('summary', $course->summary) }}</textarea>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="description">توضیحات </label>
                                    <textarea id="description" name="description"
                                              style="width: 100%; height: 200px; border: 1px solid #dddddd; padding: 10px;"
                                              class="form-control">{!! old('description', $course->description) !!}</textarea>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="thumbnail">تصویر بند انگشتی</label>
                                        <label class="form-control">
                                            <span>{{ $course->thumbnail ?? 'انتخاب کنید ...' }}</span>
                                            <input type="file" class="custom-file-input" accept="image/*"
                                                   id="thumbnail" name="thumbnail" value="{{ old('thumbnail') }}"
                                                   hidden>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">تصویر شاخص </label>
                                        <label class="form-control">
                                            <span>{{ $course->image ?? 'انتخاب کنید ...' }}</span>
                                            <input type="file" class="custom-file-input" accept="image/*"
                                                   id="image" name="image" value="{{ old('image') }}"
                                                   hidden>
                                        </label>
                                    </div>
                                </div>
                            </div>
{{--                            <div class="row">--}}
{{--                                <hr>--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <p>در صورتی که دوره رایگان نیست این قسمت را تکمیل فرمایید</p>--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="price">قیمت</label>--}}
{{--                                        <input type="text" class="form-control" id="price" placeholder="قیمت"--}}
{{--                                               value="{{ old('price', $course->price) }}" name="price">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="discount">تخفیف</label>--}}
{{--                                        <input type="text" class="form-control" id="discount" placeholder="تخفیف"--}}
{{--                                               value="{{ old('discount', $course->discount) }}" name="discount">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <hr>
                            <h5>
                                SEO
                                <small>برای بهتر دیده شدن این بخش را کامل کنید</small>
                            </h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="meta_keywords">کلمات کلیدی</label>
                                        <input type="text" class="form-control" id="meta_keywords"
                                               placeholder="HTML, CSS, JavaScript"
                                               value="{{ old('meta_keywords', $course->meta_keywords) }}" name="meta_keywords">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="meta_description">توضیحات(بین ۱۳۵ تا ۱۶۰ کاراکتر باشد)</label>
                                    <textarea id="meta_description" name="meta_description" minlength="135"
                                              maxlength="160"
                                              class="form-control">{{old('meta_description', $course->meta_description) }}</textarea>
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
    <script src="{{ asset('assets/admin/adminLTE/components/tinymce/tinymce.min.js') }}"></script>
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
