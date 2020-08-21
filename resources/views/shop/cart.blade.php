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
                    @if(count($items))
                        <div class="table-responsive">
                            <form method="post" action="{{ route('orders.store') }}">
                                @csrf
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
                                        <tr id="product_row_{{$item['id']}}" class="product_row">
                                            <input type="hidden" name="items[{{ $item['id'] }}][id]"
                                                   value="{{ $item['id'] }}">
                                            <input type="hidden" id="product_price_{{ $item['id'] }}"
                                                   value="{{ $item['price'] }}">
                                            <input type="hidden" id="product_quantity_{{ $item['id'] }}"
                                                   name="items[{{ $item['id'] }}][quantity]"
                                                   value="{{ $item['quantity'] }}">
                                            <td>
                                                <div class="view overlay">
                                                    <img src="{{ $item['image'] }}"
                                                         class="img-fluid" alt="{{ $item['name'] }}">
                                                    <a>
                                                        <div
                                                            class="mask rgba-white-slight waves-effect waves-light"></div>
                                                    </a>
                                                </div>
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
                                                            <input type="radio" name="options" id="option1"
                                                                   onclick="stepDownQty({{$item['id']}})">&mdash;
                                                        </label>
                                                        <label class="btn btn-sm btn-primary btn-rounded">
                                                            <input type="radio" name="options" id="option2"
                                                                   onclick="stepUpQty({{$item['id']}})">+
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="font-weight-bold">
                                                <strong>
                                                    <span
                                                        class="price">{{ number_format($item['total_price']) }} </span>
                                                    تومان
                                                </strong>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Remove item"
                                                        onclick="removeQty({{$item['id']}})">X
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
                                                <strong> <span id="totalPrice">{{ number_format($totalPrice) }} </span>
                                                    تومان
                                                </strong>
                                            </h4>
                                        </td>

                                        <td colspan="3" class="text-right">
                                            <button type="submit"
                                                    class="btn btn-primary btn-rounded waves-effect waves-light">
                                                تکمیل خرید
                                                <i class="fas fa-angle-left left"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    @else
                        <div class="alert alert-primary mt-3" role="alert">
                            سبد خرید شما خالی است
                            <a href="{{ route('shop.index') }}" class="alert-link">بریم خرید !!</a>
                        </div>
                    @endif
                </div>
            </div>

        </section>
    </div>
@endsection

@section('js')
    <script>
        let updateCartRoute = '{{ route('shop.cart.add', ['product' => 'productId', 'count'=> 'productCount']) }}';
    </script>

    <script>
        function stepUpQty(id) {
            let qtyElem = $('#product_row_' + id + ' .qty');
            let cartCountElem = $('#cart_count');
            let qty = parseInt(qtyElem.html());

            if (qty < 10000) {
                qty++

                $.get(updateCartRoute.replace("productId", id).replace("productCount", '1'), function () {
                    qtyElem.html(qty)
                    $('#product_quantity_' + id).attr('value', qty);
                    cartCountElem.html(parseInt(cartCountElem.html()) + 1);

                    calculatePrices();
                });
            }
        }

        function stepDownQty(id) {
            let qtyElem = $('#product_row_' + id + ' .qty');
            let cartCountElem = $('#cart_count');
            let qty = parseInt(qtyElem.html());

            if (qty > 0) {
                qty--

                $.get(updateCartRoute.replace("productId", id).replace("productCount", '-1'), function () {
                    qtyElem.html(qty)
                    $('#product_quantity_' + id).attr('value', qty);
                    cartCountElem.html(parseInt(cartCountElem.html()) - 1);

                    calculatePrices();
                });
            }
        }

        function removeQty(id) {
            let qtyElem = $('#product_row_' + id + ' .qty');
            let rowElem = $('#product_row_' + id);
            let cartCountElem = $('#cart_count');
            let qty = parseInt(qtyElem.html());

            if (qty > 0) {
                rowElem.remove();

                $.get(updateCartRoute.replace("productId", id).replace("productCount", '-' + qty), function () {
                    qtyElem.html(qty)
                    cartCountElem.html(parseInt(cartCountElem.html()) - qty);
                    calculatePrices();
                });
            }
        }

        function calculatePrices() {
            let prices = [0];
            $('.product_row').each(function (i, obj) {
                // console.log(i, obj)
                let id = $(obj).attr('id');
                id = id.replace('product_row_', '');

                let price = parseInt($('#product_price_' + id).val());
                let quantity = parseInt($('#product_quantity_' + id).val());

                console.log(id, price, quantity)

                $(obj).find('.price').html(number_format(price * quantity));

                prices.push(price * quantity);
            });
            console.log(prices)

            var sum = prices.reduce(function (previousValue, currentValue) {
                return currentValue + previousValue;
            });

            $('#totalPrice').html(number_format(sum))
        }

    </script>
@endsection

@section('footer')
@stop
