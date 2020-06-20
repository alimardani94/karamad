@extends('admin.layout.base')

@section('title', 'خانه')
@section('product', 'active menu-open')
@section('product2', 'active')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/vendor/dropzone-5.7.0/min/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/dropzone-5.7.0/min/basic.min.css')}}">
@endsection

@section('header')
    <section class="content-header">
        <h1>
            افزودن محصول جدید
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">محصولات</a></li>
            <li class="active">افزودن محصول</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form method="product" action="{{route('admin.products.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-header"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">عنوان</label>
                                        <input type="text" class="form-control" id="title" placeholder="عنوان"
                                               value="{{old('title')}}" name="title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">دسته</label>
                                        <select type="text" class="form-control select2" id="category" name="category"
                                                style="width: 100%;">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{in_array($category->id, old('category', [])) ? 'selected':''}}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tags">برچسب ها</label>
                                        <select type="text" class="form-control select2" id="tags" name="tags[]"
                                                multiple="multiple" style="width: 100%;">
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
                                <div class="col-md-12">
                                    <label>تصاویر</label>
                                    <div id="dropzone" class="dropzone needsclick dz-clickable"
                                         data-action="{{route('admin.upload.image')}}">
                                        <div class="dz-message">
                                            <div><i class="fas fa-plus"></i></div>
                                            <div>برای بارگذاری تصاویر اینجا کلیک کنید.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="description">توضیحات</label>
                                    <textarea id="description" name="description"
                                              style="width: 100%; height: 210px; border: 1px solid #dddddd; padding: 10px;"
                                              class="form-control">{!! old('description') !!}</textarea>
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
                                        <input type="text" class="form-control" id="meta_keywords"
                                               placeholder="HTML, CSS, JavaScript"
                                               value="{{old('meta_keywords')}}" name="meta_keywords">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="meta_description">توضیحات(بین ۱۳۵ تا ۱۶۰ کاراکتر باشد)</label>
                                    <textarea id="meta_description" name="meta_description" minlength="135"
                                              maxlength="160"
                                              class="form-control">{{old('meta_description')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">افزودن محصول جدید</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('js')
    <script type="text/javascript" src="{{ asset('assets/admin/adminLTE/components/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/dropzone-5.7.0/min/dropzone.min.js')}}"></script>

    <script>

        var myDropzone = new Dropzone("#dropzone", {
            url: $('#dropzone').data('action'),
            method: 'post',
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            },
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 30,
            acceptedFiles: 'image/*',
            dictInvalidFileType: 'فایل قابل قبول نمیباشد.',
            thumbnailMethod: 'contain',
            addRemoveLinks: true,
            dictRemoveFile: '✘',
            init: function () {
                this.on("addedfile", function (file) {

                    var mainImgButton = Dropzone.createElement("<a class='btn btn-default set-main-img'>پیشفرض</a>");
                    var fileName = Object.values(file)[0];
                    var _this = this;
                    mainImgButton.addEventListener("click", function (e) {
                        var temp;
                        uploadedFiles.forEach(function (item, index) {
                            if (item.file === file || item.fileName === fileName) {
                                temp = item;
                                uploadedFiles[index] = uploadedFiles[0];
                                uploadedFiles[0] = temp;
                            }
                        });
                        $('.set-main-img').css('display', 'block');
                        $(file.previewElement).find('.set-main-img').css('display', 'none');
                    });
                    //Add the button to the file preview element.
                    file.previewElement.appendChild(mainImgButton);
                });

                this.on("removedfile", function (file) {
                    var fileName = Object.values(file)[0]
                    uploadedFiles.forEach(function (item, index) {
                        if (item.file === file) {
                            uploadedFiles.splice(index, 1);
                        }
                        if (item.fileName === fileName) {
                            uploadedFiles.splice(index, 1);
                            myDropzone.options.maxFiles = myDropzone.options.maxFiles + 1;
                        }
                    });
                });

                this.on("success", function (file, responseText) {
                    uploadedFiles.push({fileName: responseText.success, file: file});
                });

                this.on("maxfilesexceeded", function (file) {
                    this.removeFile(file);
                    toastr.warning('شما نمیتوانید تصویر بیشتری آپلود کنید.');
                });

            }
        });
    </script>
@endsection
