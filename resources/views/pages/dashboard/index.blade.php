@extends('pages.dashboard.layout.base')

@section('title', 'داشبورد')

@section('header')
    @include('pages.header.header2')
@stop

@section('style')
    <style>
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
        <div class="tab-pane fade show active h-100" id="home"
             role="tabpanel" aria-labelledby="home_tab">
            @include('pages.dashboard.tabs.dashboard')
        </div>

        {{--    create product tab     --}}
        <div class="tab-pane fade h-100" id="create_product"
             role="tabpanel" aria-labelledby="create_product_tab">
            @include('pages.dashboard.tabs.create_product')
        </div>

        {{--    courses tab     --}}
        <div class="tab-pane fade h-100" id="courses" role="tabpanel"
             aria-labelledby="courses_tab">
            @include('pages.dashboard.tabs.courses')
        </div>

        {{--    orders tab     --}}
        <div class="tab-pane fade h-100" id="orders" role="tabpanel"
             aria-labelledby="orders_tab">
            @include('pages.dashboard.tabs.orders')
        </div>

        {{--    transactions tab     --}}
        <div class="tab-pane fade h-100" id="transactions" role="tabpanel"
             aria-labelledby="transactions_tab">
            @include('pages.dashboard.tabs.transactions')
        </div>

        {{--    profile tab     --}}
        <div class="tab-pane fade h-100" id="profile" role="tabpanel"
             aria-labelledby="profile_tab">
            @include('pages.dashboard.tabs.profile')
        </div>
    </div>
@endsection

@section('js')
    <script>
        let deleteOrderUrl = '{{ route('dashboard.orders.destroy', ['order' => 'orderId']) }}';
    </script>
    <script>
        "use strict";

        let Products = function () {
            let _createPage = function () {

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
            Products.init();
            Orders.init();
        });
    </script>
@endsection

