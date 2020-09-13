@extends('admin.layout.base')

@section('title', 'خانه')
@section('product', 'active menu-open')
@section('product1', 'active')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropzone-5.7.0/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropzone-5.7.0/min/basic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
@endsection

@section('header')
    <section class="content-header">
        <h1>
            ویرایش محصول
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">محصولات</a></li>
            <li class="active">ویرایش محصول</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form method="post" id="productForm"
                          action="{{ route('admin.products.update', ['product' => $product->id]) }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-header"></div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">عنوان</label>
                                        <input type="text" class="form-control" id="name" placeholder="عنوان"
                                               value="{{ old('name', $product->name) }}" name="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">دسته</label>
                                        <select type="text" class="form-control select2" id="category" name="category"
                                                style="width: 100%;">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{$category->id == old('category', $product->category_id) ? 'selected':''}}>
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
                                                    {{in_array($tag->id, old('tags', $product->tags()->pluck('id')->toArray())) ? 'selected':''}}>
                                                    {{ $tag->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">نوع محصول</label>
                                        <select type="text" class="form-control select2" id="type" name="type"
                                                style="width: 100%;">
                                            <option selected disabled>انتخاب کنید</option>
                                            @foreach($types as $type=>$index)
                                                <option value="{{ $index }}"
                                                    {{ $index == old('type', $product->type) ? 'selected':''}}>
                                                    {{ $type }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6" id="product_type_digital" style="display: none">
                                    <div class="form-group">
                                        <label for="file">فایل محصول</label>
                                        <label class="form-control">
                                            <span>{{ $product->file ?? 'انتخاب کنید ...' }}</span>
                                            <input type="file" class="custom-file-input"
                                                   id="file" name="file" hidden>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6" id="product_type_physical" style="display: none">
                                    <div class="form-group">
                                        <label for="quantity">تعداد</label>
                                        <input type="number" class="form-control" id="quantity" placeholder="تعداد"
                                               value="{{ old('quantity', $product->quantity) }}" name="quantity">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">قیمت</label>
                                        <input type="number" class="form-control" id="price" placeholder="قیمت"
                                               value="{{ old('price', $product->price) }}" name="price">
                                    </div>
                                </div>
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <div class="form-group">--}}
                                {{--                                        <label for="discount">تخفیف</label>--}}
                                {{--                                        <input type="number" class="form-control" id="discount" placeholder="تخفیف"--}}
                                {{--                                               value="{{ old('discount') }}" name="discount">--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>

                            {{--                            <div class="row">--}}
                            {{--                                <div class="col-md-6">--}}
                            {{--                                    <div class="form-group">--}}
                            {{--                                        <label for="attachment">فایل ضمیمه</label>--}}
                            {{--                                        <label class="form-control">--}}
                            {{--                                            <span> انتخاب کنید ... </span>--}}
                            {{--                                            <input type="file" class="custom-file-input"--}}
                            {{--                                                   id="attachment" name="attachment" hidden>--}}
                            {{--                                        </label>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}

                            <div class="row">
                                <div class="col-md-12">
                                    <label>تصاویر</label>
                                    <div id="dropzone" class="needsclick dz-clickable"
                                         data-action="{{ route('admin.upload.dropzone') }}">
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
                                    <label for="features">ویزگی ها
                                        <small> (پس از وارد کردن هر کدام کلید Enter را فشار دهید) </small>
                                    </label>
                                    <select multiple name="features[]" id="features">
                                        @foreach( old('features', $product->features()) as $feature)
                                            <option value="{{$feature}}">{{$feature}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="description">توضیحات</label>
                                    <textarea id="description" name="description"
                                              style="width: 100%; height: 210px; border: 1px solid #dddddd; padding: 10px;"
                                              class="form-control">{!! old('description', $product->description) !!}</textarea>
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
                                               value="{{ old('meta_keywords', $product->meta_keywords) }}"
                                               name="meta_keywords">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="meta_description">توضیحات(بین ۱۳۵ تا ۱۶۰ کاراکتر باشد)</label>
                                    <textarea id="meta_description" name="meta_description" minlength="135"
                                              maxlength="160"
                                              class="form-control">{{old('meta_description', $product->meta_description)}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">ویرایش محصول</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('js')
    <script type="text/javascript" src="{{ asset('assets/admin/adminLTE/components/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/dropzone-5.7.0/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/admin/adminLTE/components/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script>
        let images = @json($product->images())
    </script>
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


        $('select#type').on('change', function () {
            let value = this.value;

            if (value === '1') {
                $('#product_type_physical').show();
                $('#product_type_digital').hide();
            } else if (value === '2') {
                $('#product_type_physical').hide();
                $('#product_type_digital').show();
            } else {
                $('#product_type_physical').hide();
                $('#product_type_digital').hide();
            }
        }).trigger('change')

        $('#features').tagsinput({
            confirmKeys: [13, 188]
        });

        $('.bootstrap-tagsinput input').on('keypress', function (e) {
            if (e.keyCode === 13) {
                e.keyCode = 188;
                e.preventDefault();
            }
        });

        let uploadedFiles = [];

        var myDropzone = new Dropzone("#dropzone", {
            url: $('#dropzone').data('action'),
            method: 'post',
            headers: {
                'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
            },
            paramName: "file",
            maxFiles: 15,
            acceptedFiles: 'image/*',
            dictInvalidFileType: 'فایل قابل قبول نمیباشد.',
            thumbnailMethod: 'contain',
            addRemoveLinks: true,
            dictRemoveFile: '✘',
            init: function () {
                this.on("removedfile", function (file) {
                    var fileName = Object.values(file)[0]
                    uploadedFiles.forEach(function (item, index) {
                        if (item.file === file) {
                            uploadedFiles.splice(index, 1);
                            console.log(uploadedFiles)
                        }
                        if (item.fileName === fileName) {
                            uploadedFiles.splice(index, 1);
                            myDropzone.options.maxFiles = myDropzone.options.maxFiles + 1;
                        }
                    });
                });

                this.on("success", function (file, responseText) {
                    uploadedFiles.push({fileName: responseText.path, file: file});
                    console.log(uploadedFiles)
                });

                this.on("maxfilesexceeded", function (file) {
                    this.removeFile(file);
                    toastr.warning('شما نمیتوانید تصویر بیشتری آپلود کنید.');
                });

            }
        });

        $(document).ready(function () {
            let mockFile = [];

            $.each(images, function (i, image) {
                mockFile[i] = {name: image, size: 12345};
                myDropzone.emit("addedfile", mockFile[i]);
                myDropzone.emit("thumbnail", mockFile[i], image);
                myDropzone.emit("complete", mockFile[i]);
                myDropzone.options.maxFiles = myDropzone.options.maxFiles - 1;
                uploadedFiles.push({fileName: image, file: ''});

            });
        });

        $("#productForm").submit(function () {
            uploadedFiles.forEach(function (item, index) {
                $("#productForm").append('<input type="hidden" name="images[' + [index] + ']" value="' + item.fileName + '" />');
            });
        });
    </script>
@endsection
