@extends('front/layout/base')

@section('title', 'صورتحساب')

@section('header')
    @include('header.header1', ['headerBG' => asset('assets/img/header/payment.jpg'), 'headerTitle'=> 'صورتحساب'])
@stop

@section('style')
@endsection
@section('content')
    <section class="m-5">

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between bd-highlight mb-3 example-parent">
                    <h5 class="card-title">
                        شماره صورتحساب: <span>{{ $invoice->id }}</span>
                        <small class="pr-3">({{ $invoice->status() }})</small>
                    </h5>
                    <div
                        class="p-2 bd-highlight col-example">{{ jDate($invoice->updated_at, 'dd MMMM yyyy - HH:mm') }}</div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="mdb-color darken-3">
                        <tr class="text-white">
                            <th>#</th>
                            <th style="width: 50%"></th>
                            <th>قیمت</th>
                            @if($invoice->status != \App\Enums\InvoiceableStatus::Pending)
                                <th>وضعیت</th>
                            @endif
                        </tr>
                        </thead>

                        <tbody>
                        @if($invoice->invoiceable_type ==  \App\Models\Order::class)
                            @foreach($invoice->invoiceable->products() as $product)
                                <tr id="order_row_{{ $invoice->invoiceable->id }}">
                                    <th scope="row">{{ $loop->index + 1 }}</th>

                                    <td>
                                        @if($product->type === \App\Enums\Shop\ProductType::Physical)
                                            <span>{{ $product->quantity }}</span>
                                            <span> عدد </span>
                                            <span>{{ $product->name }}</span>
                                        @else
                                            <span>{{ $product->name }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span>{{ number_format($product->price) }} تومان </span>
                                    </td>
                                    @if($invoice->status != \App\Enums\InvoiceableStatus::Pending)
                                        <td>
                                            @if($product->type == \App\Enums\Shop\ProductType::Physical)
                                                <span>{{ $invoice->status() }}</span>
                                            @else
                                                <a href="{{ asset('media/' . $product->file) }}">دانلود</a>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>

                <div class="mt-2">
                    <span>مبلغ نهایی: </span>
                    <strong>
                        {{ number_format($invoice->amount) }} تومان
                    </strong>
                </div>

                @if($invoice->status == \App\Enums\InvoiceableStatus::Pending)
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/img/psp/' . $invoice->gateway . '.png') }}"
                             width="100" style="border: 2px solid #7171b5"
                             alt="{{ $invoice->gateway }}">
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('invoices.pay' , ['invoice' => $invoice->id]) }}"
                           class="btn btn-primary btn-rounded">پرداخت
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('js')

@endsection

@section('footer')
    @include('footer.footer1')
@stop
