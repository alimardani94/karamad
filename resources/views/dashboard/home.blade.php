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
                                    <h3 class="font-weight-bold dark-grey-text">{{ $courses->total() }}</h3>
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
                                    <h3 class="font-weight-bold dark-grey-text">{{ $orders->total() }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                            <div class="card card-cascade cascading-admin-card blue lighten-5">
                                <div class="admin-up">
                                    <i class="far fa-money-bill-alt primary-color mr-3 z-depth-2 float-left"></i>
                                    <div class="data">
                                        <h4 class="text-uppercase">تراکنش</h4>
                                    </div>
                                </div>
                                <div class="card-body card-body-cascade">
                                    <h3 class="font-weight-bold dark-grey-text">{{ $transactions->total() }}</h3>
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
                    <div class="row">
                        @foreach($courses as $course)
                            <div class="col-md-4">
                                <div class="card m-1 h-100">
                                    <div class="view overlay">
                                        <img src="{{asset('media/' .$course->thumbnail)}}" class="card-img-top"
                                             alt="{{$course->title}}">
                                        <a href="{{route('courses.show', ['course' => $course->id])}}">
                                            <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <a href="" class="teal-text text-center text-uppercase font-small"></a>
                                        <h5 class="card-title">
                                            <a href="{{route('courses.show', ['course' => $course->id])}}">
                                                <strong class="black-text">{{$course->title}}</strong>
                                            </a>
                                        </h5>
                                        <hr>
                                        <p class="dark-grey-text mb-4 course-summary">
                                            {{$course->summary}}
                                        </p>
                                        <p class="text-left mb-0 font-small">
                                            <a class="btn btn-default btn-sm"
                                               href="{{route('courses.show', ['course' => $course->id])}}">
                                                مشاهده
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
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
                                <tr id="order_row_{{ $order->id }}">
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

                    <div class="table-responsive">
                        <table class="table">
                            <thead class="mdb-color darken-3">
                            <tr class="text-white">
                                <th>#</th>
                                <th>قیمت کل</th>
                                <th>تاریخ</th>
                                <th>وضعیت</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr id="order_row_{{ $transaction->id }}">
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ number_format($transaction->amount) }}</td>
                                    <td>{{ jDate($transaction->created_at, 'dd MMMM yyyy - HH:mm') }}</td>
                                    <td>در انتظار پرداخت</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

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

@section('js')
    <script>
        let deleteOrderUrl = '{{ route('dashboard.orders.destroy', ['order' => 'orderId']) }}';
    </script>
    <script>
        function removeOrder(orderId) {
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
        }
    </script>
@endsection

