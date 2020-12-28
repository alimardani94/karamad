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

        #datatable_wrapper .dataTables_scrollHead {
            display: none;
        }

        #datatable_wrapper .dataTables_scrollBody {
            overflow: unset !important;
        }

        #datatable_wrapper table {
            display: block;
            width: 100% !important;
        }

        #datatable_wrapper #datatable tbody {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        #datatable_wrapper #datatable tbody tr {
            max-width: 220px !important;
            margin: 10px;
            text-align: center;
            cursor: unset;
        }

        #datatable_wrapper #datatable tbody tr td {
            display: block;
            word-break: break-word;
        }

        table.dataTable.no-footer {
            border: none;
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

        {{--    products tab     --}}
        <div class="tab-pane fade h-100" id="products" role="tabpanel" aria-labelledby="products_tab">
            @include('pages.dashboard.tabs.products')
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
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
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
            let _getProducts = function () {
                const Cols = [
                    {
                        name: "operation",
                        title: "",
                        render: function (data, type, row) {
                            let discount = ' ';
                            if (row['discount'] !== 0) {
                                discount =
                                    '<span class="grey-text">\n' +
                                    '     <small>\n' +
                                    '         <s>' + row['price'] + '</s>\n' +
                                    '     </small>\n' +
                                    '</span>\n';
                            }

                            return '' +
                                '<div class="card card-ecommerce h-100 m-1">\n' +
                                '    <div class="view overlay" style="max-height: 220px">\n' +
                                '        <img src="' + row['image'] + '"\n' +
                                '             class="card-img-top" alt="' + row['name'] + '">\n' +
                                '        <a href="' + row['link'] + '">\n' +
                                '            <div class="mask rgba-white-slight waves-effect waves-light"></div>\n' +
                                '        </a>\n' +
                                '    </div>\n' +
                                '    <div class="card-body">\n' +
                                '        <h5 class="card-title mb-1">\n' +
                                '            <strong>\n' +
                                '                <a href="' + row['link'] + '"\n' +
                                '                   class="dark-grey-text">\n' +
                                '                    ' + row['name'] + '\n' +
                                '                </a>\n' +
                                '            </strong>\n' +
                                '        </h5>\n' +
                                '        <div>\n' +
                                '            <a href="' + row['link'] + '"\n' +
                                '               class="my-3">\n' +
                                '                نام مدرسه:   ' +
                                '                ' + row['school'] + '\n' +
                                '            </a>\n' +
                                '        </div>\n' +
                                '        <div class="card-footer px-0 pb-0 d-flex justify-content-around">\n' +
                                '            <div class="">\n' +
                                discount +
                                '                <strong>' + row['final_price'] + '</strong>\n' +
                                '   تومان   ' +
                                '            </div>\n' +
                                '            <div class="">\n' +
                                '                <a href=""\n' +
                                '  data-toggle="tooltip" data-placement="top" title="افزودن به سبد خرید"\n' +
                                '                   data-original-title="افزودن به سبد خرید">\n' +
                                '                    <i class="fad fa-shopping-basket mr-3"></i>\n' +
                                '                </a>\n' +
                                '            </div>\n' +
                                '        </div>\n' +
                                '    </div>\n' +
                                '</div>\n';
                        },
                        orderable: false,
                    }, {
                        name: "id",
                        render: function (data, type, row, meta) {
                            return row['id'];
                        },
                        orderable: true,
                        visible: false,
                    }, {
                        name: "price",
                        render: function (data, type, row, meta) {
                            return row['price'];
                        },
                        orderable: true,
                        visible: false,
                    }
                ];

                let tableElement = $("#products_datatable");
                tableElement.DataTable({
                    processing: true,
                    serverSide: true,
                    searching: true,
                    paging: true,
                    scrollX: true,
                    buttons: [],
                    dom: "<t><p>",
                    pageLength: 25,
                    order: [[1, "desc"]],
                    language: {
                        url: tableElement.data('lang')
                    },
                    columns: Cols,
                    ajax: {
                        type: 'POST',
                        dataType: "json",
                        url: tableElement.data('action'),
                        headers: {
                            'X-CSRF-Token': $('meta[name=csrf_token]').attr('content')
                        },
                        dataSrc: function (response) {
                            return response.data;
                        }
                    },
                    rowCallback: function (row, data) {
                        // $(row).addClass('zoom-in box');
                    }
                });
            }

            return {
                init: function () {
                    _createPage();
                    _getProducts();
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

