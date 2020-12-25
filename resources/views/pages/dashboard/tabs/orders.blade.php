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
                            <button data-id="{{ $order->id }}" type="button"
                                    class="remove-order btn btn-sm btn-danger btn-rounded">حذف
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
