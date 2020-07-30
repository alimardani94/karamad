@extends('front/layout/base')

@section('title', 'فروشگاه')

@section('header')
    @include('header.header2')
@stop

@section('style')

@endsection

@section('content')
    <div class="container mt-2 pt-2">
        <section class="section my-5 pb-5">

            <div class="card card-ecommerce">
                <div class="card-body">

                    <!-- Shopping Cart table -->
                    <div class="table-responsive">

                        <table class="table product-table table-cart-v-2">

                            <thead class="mdb-color lighten-5">
                            <tr>
                                <th></th>

                                <th class="font-weight-bold">
                                    <strong>نام</strong>
                                </th>

                                <th></th>

                                <th class="font-weight-bold">
                                    <strong>قیمت</strong>
                                </th>

                                <th class="font-weight-bold">
                                    <strong>تعداد</strong>
                                </th>

                                <th class="font-weight-bold">
                                    <strong>مجموع</strong>
                                </th>

                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>
                                        <img
                                            src="{{ $item['image'] }}"
                                            alt="{{ $item['name'] }}"
                                            class="img-fluid z-depth-0">
                                    </td>
                                    <td>
                                        <h5 class="mt-3">
                                            <strong>{{ $item['name'] }}</strong>
                                        </h5>
                                    </td>
                                    <td></td>
                                    <td>{{ number_format($item['price']) }} تومان</td>

                                    <td class="text-center text-md-right">
                                        <span class="qty"> {{ $item['quantity'] }} </span>
                                        @if($item['type'] == \App\Enums\Shop\ProductType::Physical)
                                            <div class="btn-group radio-group ml-2" data-toggle="buttons">
                                                <label class="btn btn-sm btn-primary btn-rounded">
                                                    <input type="radio" name="options" id="option1" onclick="stepDown()">&mdash;
                                                </label>
                                                <label class="btn btn-sm btn-primary btn-rounded">
                                                    <input type="radio" name="options" id="option2" onclick="stepUp()">+
                                                </label>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="font-weight-bold">
                                        <strong> {{ number_format($item['total_price']) }} تومان </strong>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip"
                                                data-placement="top"
                                                title="Remove item">X
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3"></td>
                                <td>
                                    <h4 class="mt-2">
                                        <strong>مجموع</strong>
                                    </h4>
                                </td>

                                <td class="text-right">
                                    <h4 class="mt-2">
                                        <strong>{{ number_format($totalPrice) }} تومان </strong>
                                    </h4>
                                </td>

                                <td colspan="3" class="text-right">
                                    <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">
                                        تکمیل خرید
                                        <i class="fas fa-angle-left left"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </section>
    </div>
@endsection

@section('js')

@endsection

@section('footer')
@stop
