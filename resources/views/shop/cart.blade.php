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
                                    <input type="hidden" name="items[{{ $item['id'] }}][product_id]"
                                           value="{{ $item['id'] }}">
                                    <input type="hidden" id="product_price_{{ $item['id'] }}"
                                           value="{{ $item['price'] }}">
                                    <input type="hidden" id="product_quantity_{{ $item['id'] }}"
                                           name="items[{{ $item['id'] }}][quantity]"
                                           value="{{ $item['quantity'] }}">
                                    <tr id="product_row_{{$item['id']}}" class="product_row">
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
                                                <span class="price">{{ number_format($item['total_price']) }} </span>
                                                تومان
                                            </strong>
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

                </div>
            </div>

        </section>
    </div>
@endsection

@section('js')
    <script>
        function stepUpQty(id) {
            let qtyElem = $('#product_row_' + id + ' .qty');
            let qty = parseInt(qtyElem.html());

            if (qty < 10000) {
                qty++
            }
            qtyElem.html(qty)
            $('#product_quantity_' + id).attr('value', qty);

            calculatePrices()
        }

        function stepDownQty(id) {
            let qtyElem = $('#product_row_' + id + ' .qty');
            let qty = parseInt(qtyElem.html());

            if (qty > 0) {
                qty--
            }
            qtyElem.html(qty)
            $('#product_quantity_' + id).attr('value', qty);

            calculatePrices()
        }

        function calculatePrices() {
            let prices = [];
            $('.product_row').each(function(i, obj) {
                // console.log(i, obj)
                let id = $(obj).attr('id');
                id = id.replace('product_row_','');

                let price = parseInt($('#product_price_' + id).val());
                let quantity = parseInt($('#product_quantity_' + id).val());

                console.log(id, price, quantity)

                $(obj).find('.price').html(number_format(price * quantity));

                prices.push(price * quantity);
            });

            var sum = prices.reduce(function(previousValue, currentValue){
                return currentValue + previousValue;
            });

            $('#totalPrice').html(number_format(sum))
        }

    </script>
@endsection

@section('footer')
@stop
