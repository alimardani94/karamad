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
