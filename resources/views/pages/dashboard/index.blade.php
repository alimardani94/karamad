@extends('pages.dashboard.layout.base')

@section('title', 'داشبورد')

@section('header')
    @include('pages.header.header2')
@stop

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropzone-5.7.0/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropzone-5.7.0/min/basic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    <style>
        .label-info {
            padding: 3px 8px;
            background-color: #00c0ef !important;
            border-radius: 6px;
        }

        .cascading-admin-card {
            margin-top: 1.25rem;
        }

        .cascading-admin-card {
            margin-top: 1.25rem;
        }

        .cascading-admin-card .admin-up {
            margin-left: 4%;
            margin-right: 4%;
            margin-top: -1.25rem;
        }

        .cascading-admin-card .admin-up .data {
            float: right;
            margin-top: 2rem;
            text-align: right;
        }

        .cascading-admin-card .admin-up .fab, .cascading-admin-card .admin-up .far, .cascading-admin-card .admin-up .fas {
            padding: 1.7rem;
            font-size: 2rem;
            color: #fff;
            text-align: left;
            border-radius: 3px;
        }
    </style>
@endsection

@section('content')
    <div class="tab-content p-0" id="tabContent">
        {{--    first tab     --}}
        <div class="tab-pane fade h-100 show active" id="home" role="tabpanel" aria-labelledby="home_tab">
            @include('pages.dashboard.tabs.dashboard')
        </div>

        {{--    create product tab     --}}
        <div class="tab-pane fade h-100" id="create_product" role="tabpanel" aria-labelledby="create_product_tab">
            @include('pages.dashboard.tabs.create_product')
        </div>

        {{--    courses tab     --}}
        <div class="tab-pane fade h-100" id="courses" role="tabpanel" aria-labelledby="courses_tab">
            @include('pages.dashboard.tabs.courses')
        </div>

        {{--    orders tab     --}}
        <div class="tab-pane fade h-100" id="orders" role="tabpanel" aria-labelledby="orders_tab">
            @include('pages.dashboard.tabs.orders')
        </div>

        {{--    transactions tab     --}}
        <div class="tab-pane fade h-100" id="transactions" role="tabpanel" aria-labelledby="transactions_tab">
            @include('pages.dashboard.tabs.transactions')
        </div>

        {{--    profile tab     --}}
        <div class="tab-pane fade h-100" id="profile" role="tabpanel" aria-labelledby="profile_tab">
            @include('pages.dashboard.tabs.profile')
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/vendor/input-mask/jquery.inputmask.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/adminLTE/components/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/dropzone-5.7.0/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/admin/adminLTE/components/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>

    <script>
        let deleteOrderUrl = '{{ route('dashboard.orders.destroy', ['order' => 'orderId']) }}';
    </script>
    <script>
        "use strict";

        let Base = function () {
            let _init = function () {
                $('.mdb-select').materialSelect();

                Inputmask.extendDefinitions({
                    '9': {
                        validator: "[\u06F0-\u06F90-9\u0660-\u0669]",
                    },
                });

                $(".numeric-input").inputmask({
                    groupSeparator: ",",
                    alias: "numeric",
                    autoGroup: true
                });

                $(".percent-input").inputmask({
                    alias: 'percentage'
                });
            }

            return {
                init: function () {
                    _init();
                }
            }
        }();

        let Products = function () {
            let _createPage = function () {
                tinymce.init({
                    selector: 'textarea#summery',
                    plugins: 'advlist autolink link lists preview table code pagebreak',
                    menubar: false,
                    language: 'fa',
                    height: 200,
                    relative_urls: false,
                    toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link',
                });

                tinymce.init({
                    selector: 'textarea#description',
                    plugins: 'advlist autolink link lists preview table code pagebreak',
                    menubar: false,
                    language: 'fa',
                    height: 300,
                    relative_urls: false,
                    toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link',
                });

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

                let myDropzone = new Dropzone("#dropzone", {
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

                $("#create_product_form").submit(function () {
                    uploadedFiles.forEach(function (item, index) {
                        $("#create_product_form").append('<input type="hidden" name="images[' + [index] + ']" value="' + item.fileName + '" />');
                    });
                });
            }

            return {
                init: function () {
                    _createPage();
                }
            }
        }();

        let Orders = function () {
            let _removeOrder = function () {
                $('.remove-order').on('click', function () {
                    let orderId = $(this).attr('data-id');

                    $.ajax({
                        method: 'DELETE',
                        dataType: 'json',
                        url: deleteOrderUrl.replace('orderId', orderId),
                        success: function (json) {
                            $('#order_row_' + orderId).remove();
                        },
                        error: function (data) {
                            console.log(data)
                        }
                    });
                })
            }

            return {
                init: function () {
                    _removeOrder();
                }
            }
        }();


        jQuery(document).ready(function () {
            Base.init();
            Products.init();
            Orders.init();
        });
    </script>
@endsection

