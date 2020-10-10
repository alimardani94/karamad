@extends('emails._layout')

@section('title', 'گزارش خرید')

@section('body')
    <strong>{{ $user->full_name }}</strong> <span>عزیز</span> سلام

    <p style="margin:10px 0">
        سفارش شما ارسال شد
    </p>

    <table style="width: 100%; border: 1px solid gray">
        <tr>
            <th>نام</th>
            <th>تعداد</th>
        </tr>
        @foreach($products as $product)

            <tr>
                <td>
                    <span>{{ $product->name }}</span>
                </td>
                <td>
                    @if($product->type === \App\Enums\Shop\ProductType::Physical)
                        <span>{{ $product->quantity }}</span>
                        <span> عدد </span>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@endsection
