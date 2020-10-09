@extends('admin.layout.base')

@section('title', $user->full_name)
@section('user', 'active menu-open')
@section('user2', 'active')

@section('header')
    <section class="content-header">
        <h1>
            کاربران <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">کاربران</a></li>
            <li class="active">لیست کاربران</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ $user->full_name }}</h3>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <tbody>
                            <tr>
                                <td>نام</td>
                                <td>{{ $user->full_name}}</td>
                            </tr>
                            <tr>
                                <td>تلفن</td>
                                <td>{{ $user->cell}}</td>
                            </tr>
                            <tr>
                                <td>ایمیل</td>
                                <td>{{ $user->email}}</td>
                            </tr>
                            <tr>
                                <td>تاریخ نام نویسی</td>
                                <td>{{jDate($user->created_at, 'dd MMMM yyyy - HH:mm')}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <br>

                        @if($orders->count())
                            <h5 class="box-title">سفارشات</h5>
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
                                            <a href="{{ route('admin.users.show', $order->user->id) }}">
                                                {{ $order->user->full_name }}
                                            </a>
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
