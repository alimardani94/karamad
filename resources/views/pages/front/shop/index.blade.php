@extends('pages.front.layout.base')

@section('title', 'فروشگاه')

@section('header')
    @include('pages.header.header2')
@stop

@section('style')
    <style>
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
            width: 200px;
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
    <div class="container">
        <div class="row pt-4">
            <div class="col-lg-12">
                <section class="section pt-4">
                    <div class="row row-cols-1 row-cols-md-4">
                        @if($products->count())
                            @foreach($products as $product)
                                <div class="col my-3">
                                    @include('pages.front.layout.single_product', ['product' => $product])
                                </div>
                            @endforeach
                        @else
                            <div class="col-lg-12">
                                <div class="alert alert-primary p-5 mt-3 mb-5" role="alert">
                                    هبچ محصولی یافت نشد
                                </div>
                            </div>
                        @endif
{{--                            <table id="datatable"--}}
{{--                                   data-lang="{{  (app()->getLocale() != 'en') ? asset('assets/vendor/datatables/' . app()->getLocale() . '.json'): '' }}"--}}
{{--                                   data-action="{{ route('shop.products.datatable') }}">--}}
{{--                            </table>--}}
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script>
        // $(document).ready(function () {
        //     const Cols = [
        //         {
        //             name: "operation",
        //             title: "عملیات",
        //             render: function (data, type, row) {
        //                 return '' +
        //                     '<div class="card card-ecommerce h-100 m-1">\n' +
        //                     '    <div class="view overlay" style="max-height: 220px">\n' +
        //                     '        <img src="row[image]"\n' +
        //                     '             class="card-img-top" alt="row[name]">\n' +
        //                     '        <a href="row[link]">\n' +
        //                     '            <div class="mask rgba-white-slight waves-effect waves-light"></div>\n' +
        //                     '        </a>\n' +
        //                     '    </div>\n' +
        //                     '\n' +
        //                     '    <div class="card-body">\n' +
        //                     '        <h5 class="card-title mb-1">\n' +
        //                     '            <strong>\n' +
        //                     '                <a href="row[link]"\n' +
        //                     '                   class="dark-grey-text">\n' +
        //                     '                    row[name]\n' +
        //                     '                </a>\n' +
        //                     '            </strong>\n' +
        //                     '        </h5>\n' +
        //                     '\n' +
        //                     '        <div>\n' +
        //                     '            <a href="row[link]"\n' +
        //                     '               class="my-3">\n' +
        //                     '                نام مدرسه:\n' +
        //                     '                row[school]\n' +
        //                     '            </a>\n' +
        //                     '        </div>\n' +
        //                     '\n' +
        //                     '        <small><span class="badge badge-primary badger mb-2">tag</span></small>\n' +
        //                     '\n' +
        //                     '        <div class="card-footer px-0 pb-0 d-flex justify-content-around">\n' +
        //                     '            <div class="">\n' +
        //                     '                <span class="grey-text">\n' +
        //                     '                    <small>\n' +
        //                     '                        <s>row[discount]</s>\n' +
        //                     '                    </small>\n' +
        //                     '                </span>\n' +
        //                     '                <strong>row[final_price]</strong>\n' +
        //                     '                تومان\n' +
        //                     '            </div>\n' +
        //                     '\n' +
        //                     '            <div class="">\n' +
        //                     '                <a href=""\n' +
        //                     '                   data-toggle="tooltip" data-placement="top" title="افزودن به سبد خرید"\n' +
        //                     '                   data-original-title="افزودن به سبد خرید">\n' +
        //                     '                    <i class="fad fa-shopping-basket mr-3"></i>\n' +
        //                     '                </a>\n' +
        //                     '            </div>\n' +
        //                     '        </div>\n' +
        //                     '    </div>\n' +
        //                     '</div>\n';
        //             },
        //             orderable: false,
        //         }, {
        //             name: "id",
        //             render: function (data, type, row, meta) {
        //                 return row['id'];
        //             },
        //             orderable: true,
        //             visible: false,
        //         }, {
        //             name: "thumbnail",
        //             title: "thumbnail",
        //             render: function (data, type, row, meta) {
        //                 return '<img alt="asset" class="" src="' + row['image'] + '">';
        //             },
        //             orderable: false,
        //         }, {
        //             name: "name",
        //             title: "نام",
        //             render: function (data, type, row, meta) {
        //                 return '<h2 class="mt-1 text-lg font-medium">' + row['name'] + '<small>';
        //             },
        //             orderable: false,
        //         }
        //     ];
        //
        //     let tableElement = $("#datatable");
        //     let table = tableElement.DataTable({
        //         processing: true,
        //         serverSide: true,
        //         searching: true,
        //         paging: true,
        //         scrollX: true,
        //         buttons: [],
        //         dom: "<'table_info'<l><r><i>><t><p>",
        //         pageLength: 25,
        //         order: [[0, "desc"]],
        //         language: {
        //             url: tableElement.data('lang')
        //         },
        //         columns: Cols,
        //         ajax: {
        //             type: 'POST',
        //             dataType: "json",
        //             url: tableElement.data('action'),
        //             headers: {
        //                 'X-CSRF-Token': $('meta[name=csrf_token]').attr('content')
        //             },
        //             dataSrc: function (response) {
        //                 return response.data;
        //             }
        //         },
        //         rowCallback: function (row, data) {
        //             $(row).addClass('zoom-in box');
        //         }
        //     });
        //
        //     $('body').on('click', '.deleteAsset', function () {
        //         let id = $(this).attr('data-id');
        //         Swal.fire({
        //             title: 'آیا محتوا حذف شود؟',
        //             text: "",
        //             icon: 'warning',
        //             showCancelButton: true,
        //             confirmButtonColor: '#3085d6',
        //             cancelButtonColor: '#d33',
        //             confirmButtonText: 'بله',
        //             cancelButtonText: 'خیر',
        //         }).then((result) => {
        //             if (result.value) {
        //                 $.ajax({
        //                     type: "DELETE",
        //                     url: deleteAssetUrl.replace('assetId', id),
        //                     success: function (response) {
        //                         console.log(response)
        //                         successToastr(response['message'])
        //                         table.ajax.reload();
        //                     },
        //                     error: function (error) {
        //                         console.log(error)
        //
        //                         switch (error.status) {
        //                             case 422:
        //                                 // validation
        //                                 $.each(error['responseJSON']['errors'], function (i, j) {
        //                                     errorToastr(j[0])
        //                                 })
        //                                 break;
        //                             default:
        //                                 // 500
        //                                 errorToastr(error['responseJSON']['message'])
        //                                 break;
        //                         }
        //                     }
        //                 });
        //             }
        //         })
        //     })
        // });
    </script>
@endsection

@section('footer')
@stop
