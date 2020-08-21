@extends('dashboard/layout/base')

@section('title', 'داشبورد')

@section('header')
    @include('header.header2')
@stop

@section('style')
    <style>

    </style>
@endsection

@section('content')

    <div class="tab-content" id="tabContent">
        <div class="tab-pane fade show active h-100" id="home"
             role="tabpanel" aria-labelledby="home-tab">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                        <div class="card card-cascade cascading-admin-card blue lighten-5">
                            <div class="admin-up">
                                <i class="fas fa-chart-pie light-blue lighten-1 mr-3 z-depth-2"></i>
                                <div class="data">
                                    <h4 class="text-uppercase">دوره ها</h4>
                                </div>
                            </div>
                            <div class="card-body card-body-cascade">
                                <h3 class="font-weight-bold dark-grey-text">0</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                        <div class="card card-cascade cascading-admin-card blue lighten-5">
                            <div class="admin-up">
                                <i class="fas fa-chart-bar red accent-2 mr-3 z-depth-2"></i>
                                <div class="data">
                                    <h4 class="text-uppercase">سفارشات</h4>
                                </div>
                            </div>
                            <div class="card-body card-body-cascade">
                                <h3 class="font-weight-bold dark-grey-text">1</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                        <div class="card card-cascade cascading-admin-card blue lighten-5">
                            <div class="admin-up">
                                <i class="far fa-money-bill-alt primary-color mr-3 z-depth-2"></i>
                                <div class="data">
                                    <h4 class="text-uppercase">رسید ها</h4>
                                </div>
                            </div>
                            <div class="card-body card-body-cascade">
                                <h3 class="font-weight-bold dark-grey-text">2</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="courses" role="tabpanel"
             aria-labelledby="courses-tab">
            <div class="card-title">دوره های من</div>
            <div class="card-body">

                3
            </div>
        </div>

        <div class="tab-pane fade" id="orders" role="tabpanel"
             aria-labelledby="orders-tab">
            <div class="card-title">سفارشات</div>
            <div class="card-body">
                <table class="table">
                    <thead class="mdb-color darken-3">
                    <tr class="text-white">
                        <th>#</th>
                        <th>محصولات</th>
                        <th>قیمت</th>
                        <th>تاریخ</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <!-- Table head -->

                    <!-- Table body -->
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <th scope="row">{{ $loop->index }}</th>
                            <td>
                                <ul>
                                    @foreach($order->products() as $product)
                                        <li>
                                            @if($product->type === \App\Enums\Shop\ProductType::Physical)
                                                <span>{{ $product->quantity }}</span>
                                                <span> عدد </span>
                                                <span>{{ $product->name }}</span>

                                                <span> - </span>
                                                <span>{{ number_format($product->price) }}</span>
                                            @else
                                                <span>{{ $product->name }}</span>

                                                <span> - </span>
                                                <span>{{ number_format($product->price) }}</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ number_format($order->total_price) }}</td>
                            <td>{{ jDate($order->created_at, 'dd MMMM yyyy - HH:mm') }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary btn-rounded">پرداخت</button>
                                <button type="button" class="btn btn-sm btn-danger btn-rounded">حذف</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="tab-pane fade" id="transactions" role="tabpanel"
             aria-labelledby="transactions-tab">
            <div class="card-title">مالی</div>
            <div class="card-body">

                6
            </div>
        </div>

        <div class="tab-pane fade" id="profile" role="tabpanel"
             aria-labelledby="profile-tab">
            <div class="card-title">پروفایل</div>
            <div class="card-body">

                2
            </div>
        </div>
    </div>

@endsection

