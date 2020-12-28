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
            max-width: 250px;
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
                    <table id="datatable"
                           data-lang="{{  (app()->getLocale() != 'en') ? asset('assets/vendor/datatables/' . app()->getLocale() . '.json'): '' }}"
                           data-action="{{ route('shop.products.datatable') }}">
                    </table>
                </section>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            const Cols = [
                {
                    name: "operation",
                    title: "عملیات",
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

            let tableElement = $("#datatable");
            let table = tableElement.DataTable({
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
                    $(row).addClass('zoom-in box');
                }
            });

        });
    </script>
@endsection

@section('footer')
@stop
