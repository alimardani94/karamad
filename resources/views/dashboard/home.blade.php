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

    <div class="tab-content p-0" id="tabContent">
        {{--    first tab     --}}
        <div class="tab-pane fade show active h-100" id="home"
             role="tabpanel" aria-labelledby="home-tab">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                            <div class="card card-cascade cascading-admin-card blue lighten-5">
                                <div class="admin-up">
                                    <i class="fas fa-university light-blue lighten-1 mr-3 z-depth-2 float-left"></i>
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
                                    <i class="fas fa-shopping-bag red accent-2 mr-3 z-depth-2 float-left"></i>
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
                                    <i class="far fa-money-bill-alt primary-color mr-3 z-depth-2 float-left"></i>
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
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>

        {{--    courses tab     --}}
        <div class="tab-pane fade" id="courses" role="tabpanel"
             aria-labelledby="courses-tab">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">دوره های من</div>

                    3
                </div>
            </div>
        </div>

        {{--    orders tab     --}}
        <div class="tab-pane fade" id="orders" role="tabpanel"
             aria-labelledby="orders-tab">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">سفارشات</div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="mdb-color darken-3">
                            <tr class="text-white">
                                <th>#</th>
                                <th></th>
                                <th>قیمت</th>
                                <th>قیمت کل</th>
                                <th>تاریخ</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
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
                                    <td>در انتظار پرداخت</td>
                                    <td>
                                        <button onclick="removeOrder({{ $order->id }})" type="button"
                                                class="btn btn-sm btn-danger btn-rounded">حذف
                                        </button>
                                        <button onclick="payOrder({{ $order->id }})" type="button"
                                                class="btn btn-sm btn-primary btn-rounded">پرداخت
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{--    transactions tab     --}}
        <div class="tab-pane fade" id="transactions" role="tabpanel"
             aria-labelledby="transactions-tab">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">مالی</div>

                    6
                </div>
            </div>
        </div>

        {{--    profile tab     --}}
        <div class="tab-pane fade" id="profile" role="tabpanel"
             aria-labelledby="profile-tab">
            <div class="card testimonial-card">

                <!-- Background color -->
                <div class="card-up card-image"
                     style="background-image: url({{ asset('assets/img/brain-2.jpg') }});">
                    <div class="rgba-black-strong h-100 p-3 white-text">
                    </div>
                </div>

                <!-- Avatar -->
                <div class="avatar mx-auto white">
                    <img src="{{ $authUser->image }}" class="rounded-circle" alt="{{ $authUser->fullname }}">
                </div>

                <!-- Content -->
                <div class="card-body px-3 py-4">


                </div>

            </div>
        </div>
    </div>

@endsection

