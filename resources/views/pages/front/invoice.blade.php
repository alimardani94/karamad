@extends('pages.front.layout.base')

@section('title', 'صورتحساب')

@section('header')
    @include('pages.header.header1', ['headerBG' => asset('assets/img/header/payment.jpg'), 'headerTitle'=> 'صورتحساب'])
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
                    <form method="post" action="{{ route('invoices.pay' , ['invoice' => $invoice->id]) }}">
                        @csrf
                        @if($invoice->invoiceable_type ==  \App\Models\Order::class)
                            @if($invoice->invoiceable->needAddress())
                                <hr class="my-5">
                                <h5>آدرس گیرنده</h5>

                                <div class="form-row my-0">
                                    <div class="col">
                                        <div class="md-form">
                                            <select name="province" id="province" class="mdb-select md-form"
                                                    searchable="جستجو کنید">
                                                <option value="" disabled selected>استان</option>
                                                @foreach($provinces as $province)
                                                    <option value="{{ $province->id }}"
                                                        {{ ($address and $address->province_id === $province->id) ? 'selected' : '' }}>
                                                        {{ $province->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="province"></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="md-form">
                                            <select name="city" id="city" class="mdb-select md-form"
                                                    searchable="جستجو کنید">
                                                <option value="" disabled selected>شهر</option>
                                            </select>
                                            <label for="city"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="md-form mb-0 mt-1">
                                    <input type="text" id="address" name="address"
                                           class="form-control" autocomplete="off"
                                           value="{{  $address->address ?? '' }}">
                                    <label for="address">ادامه آدرس</label>
                                </div>
                                <div class="form-row mt-0 mb-5">
                                    <div class="col">
                                        <div class="md-form">
                                            <input type="text" id="postal_code" name="postal_code"
                                                   class="form-control"
                                                   value="{{  $address->postal_code ?? '' }}">
                                            <label for="postal_code">کد پستی<small> (اختیاری) </small></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="md-form">
                                            <input type="text" id="name" name="name"
                                                   class="form-control"
                                                   value="{{ $address->name ?? '' }}">
                                            <label for="name">نام گیرنده</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif

                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('assets/img/psp/' . $invoice->gateway . '.png') }}"
                                 width="100" style="border: 2px solid #7171b5"
                                 alt="{{ $invoice->gateway }}">
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button class="btn btn-primary btn-rounded" type="submit">پرداخت</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        let getCitiesUrl = '{{ route('cities') }}';
        let defaultCity = '{{ $address->city_id ?? '0' }}';
    </script>
    <script>
        $(document).ready(function () {
            function getCities(province, selected = '') {
                if (province === '0' || province === null || province === '') {
                    return false;
                }

                $.ajax({
                    url: getCitiesUrl,
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        province: province,
                    },
                    success: function (data) {
                        let citySelect = $("#city");
                        let provinceSelect = $("#province");
                        citySelect.val('').attr('disabled', true);
                        provinceSelect.attr('disabled', true);

                        citySelect.html($('<option>', {
                            value: '',
                            text: 'شهر',
                            disabled: 'disabled',
                            selected: 'selected',
                        }));
                        $.each(data, function (i, item) {
                            let selectedTxt = false;
                            if (i === selected) {
                                selectedTxt = 'selected';
                            }

                            citySelect.append($('<option>', {
                                value: i,
                                text: item,
                                selected: selectedTxt
                            }));
                        });

                        citySelect.attr('disabled', false);
                        provinceSelect.attr('disabled', false);

                        citySelect.materialSelect({destroy: true});
                        citySelect.materialSelect();
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }

            $('.mdb-select').materialSelect();


            $('#province').on('change', function () {
                getCities(this.value, defaultCity);
            }).trigger('change')
        });
    </script>
@endsection

@section('footer')
    @include('pages.footer.footer1')
@stop
