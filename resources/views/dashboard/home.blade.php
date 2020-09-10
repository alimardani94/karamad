@extends('dashboard/layout/base')

@section('title', 'داشبورد')

@section('header')
    @include('header.header2')
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
                    <div class="row row-cols-1 row-cols-md-4">
                        @foreach($courses as $course)
                            <div class="col my-3">
                                @include('front.layout.single_course', ['course' => $course, 'summarize'=> true])
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
                                    <td>{{ $order->status() }}</td>
                                    <td>
                                        <button onclick="removeOrder({{ $order->id }})" type="button"
                                                class="btn btn-sm btn-danger btn-rounded">حذف
                                        </button>
                                        @if($order->status == \App\Enums\InvoiceableStatus::Pending)
                                            <a href="{{ route('dashboard.orders.pay' , ['order' => $order->id]) }}"
                                               class="btn btn-sm btn-primary btn-rounded">پرداخت
                                            </a>
                                        @else
                                            <a href="{{ route('invoices.show', ['invoice' => $order->invoices->first()->id]) }}"
                                               class="btn btn-sm btn-secondary btn-rounded">مشاهده
                                            </a>
                                        @endif
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
                                <th>بابت</th>
                                <th>تاریخ</th>
                                <th>وضعیت</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr id="order_row_{{ $transaction->id }}">
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ number_format($transaction->amount) }}</td>
                                    <td><a href="">خرید از فروشگاه</a></td>
                                    <td>{{ jDate($transaction->created_at, 'dd MMMM yyyy - HH:mm') }}</td>
                                    <td>{{ $transaction->status() }}</td>
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
                    <img id="profile-pic" src="{{ $authUser->image }}" class="rounded-circle"
                         alt="{{ $authUser->fullname }}">
                </div>
                <form method="post" action="{{ route('dashboard.profile.image.update') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="file-field">
                        <div class="d-flex justify-content-center">
                            <div class="btn btn-mdb-color btn-rounded float-left">
                                <span>ویرایش تصویر</span>
                                <input type="file" name="image" accept="image/*" onchange="form.submit()">
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Content -->
                <div class="card-body px-3 py-4">
                    <div class="row text-center py-4">
                        <h2 class="font-weight-bold mx-auto">ویرایش اطلاعات</h2>
                    </div>
                    <form id="editForm" method="post" class="text-center md-form"
                          action="{{ route('dashboard.profile.update') }}">
                        @csrf
                        <div class="form-row">
                            <div class="col">
                                <div class="md-form">
                                    <label for="name">نام</label>
                                    <input type="text" id="name" name="name"
                                           class="form-control  @error('name') is-invalid @enderror"
                                           value="{{ $authUser->name }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form">
                                    <label for="surname">نام خانوادگی</label>
                                    <input type="text" id="surname" name="surname"
                                           class="form-control  @error('surname') is-invalid @enderror"
                                           value="{{ $authUser->surname }}">
                                    @error('surname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form">
                                    <label for="email">ایمیل</label>
                                    <input type="text" id="email" name="email" value="{{ $authUser->email }}"
                                           class="form-control  @error('email') is-invalid @enderror"
                                           autocomplete="off">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="md-form">
                                    <label for="cell">شماره موبایل</label>
                                    <input type="text" id="cell" name="cell"
                                           class="form-control  @error('cell') is-invalid @enderror"
                                           value="{{ $authUser->cell }}">
                                    @error('cell')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit"
                                    class="btn btn-outline-info btn-rounded  my-4 waves-effect z-depth-0">
                                ویرایش
                            </button>
                        </div>
                    </form>

                    <div class="row text-center py-4">
                        <h2 class="font-weight-bold mx-auto">تغییر گذرواژه</h2>
                    </div>
                    <form id="editPassForm" method="post" class="text-center md-form"
                          action="{{ route('dashboard.profile.password.change') }}">
                        @csrf
                        <div class="row justify-content-center form-row">
                            <div class="col-md-6 text-center">
                                <div class="md-form">
                                    <label for="current_password">گذرواژه کنونی</label>
                                    <input type="password" id="current_password" name="current_password"
                                           class="form-control @error('current_password') is-invalid @enderror">
                                    @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="md-form">
                                    <label for="password">گذرواژه جدید</label>
                                    <input type="text" id="password" name="password"
                                           class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form">
                                    <label for="password_confirmation">تکرار گذرواژه</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                           class="form-control @error('password_confirmation') is-invalid @enderror">
                                    @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit"
                                    class="btn btn-outline-info btn-rounded my-4 waves-effect z-depth-0">
                                تغییر گذرواژه
                            </button>
                        </div>
                    </form>

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

