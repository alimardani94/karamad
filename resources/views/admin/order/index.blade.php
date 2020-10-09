@extends('admin.layout.base')

@section('title', 'خانه')
@section('order', 'active menu-open')
@section('order1', 'active')

@section('header')
    <section class="content-header">
        <h1>
            سفارشات <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">سفارشات</a></li>
            <li class="active">لیست سفارشات</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">لیست سفارشات</h3>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>خریدار</th>
                                <th></th>
                                <th>قیمت</th>
                                <th>قیمت کل</th>
                                <th>تاریخ</th>
                                <th>آدرس</th>
                                <th>وضعیت</th>
                                <th>-</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>
                                        <a href="mailto:{{ $order->user->email }}">{{ $order->user->full_name }}</a>
                                    </td>
                                    <td>
                                        <ul class="pr-1">
                                            @foreach($order->products() as $product)
                                                <li>
                                                    @if($product->type === \App\Enums\Shop\ProductType::Physical)
                                                        <span>{{ $product->quantity }}</span>
                                                        <span> عدد </span>
                                                        <span>{{ $product->name }}</span>
                                                    @else
                                                        <span>{{ $product->name }}</span>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="pr-1">
                                            @foreach($order->products() as $product)
                                                <li>
                                                    <span>{{ number_format($product->price) }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ number_format($order->total_price) }}</td>
                                    <td>{{ jDate($order->created_at, 'dd MMMM yyyy - HH:mm') }}</td>
                                    <td>{{ $order->address->toString() }}</td>
                                    <td>{{ $order->status() }}</td>
                                    <td>
                                        @if($order->status == \App\Enums\InvoiceableStatus::Payed)
                                            <a type="button" class="btn btn-block btn-default btn-xs"
                                               onclick="makeShipped({{ $order->id}})">
                                                ارسال شد
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        let changeStatusRoute = "{{ route('admin.orders.change-status', ['order' => 'orderId']) }}";
        let statuses = @json(\App\Enums\InvoiceableStatus::all())
    </script>
    <script>
        function makeShipped(id) {
            let url = changeStatusRoute.replace('orderId', id)
            Swal.fire({
                title: 'آیا وضعیت به ارسال شده تغییر کند',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            'status': statuses['Shipped'],
                        },
                        success: function (response) {
                            // window.location.reload();
                        },
                        error: function (e) {
                            if (e.responseJSON.message != undefined) {
                                toastr.error(e.responseJSON.message);
                            } else {
                                toastr.error();
                            }
                        }
                    });
                }
            })
        }
    </script>
@endsection

