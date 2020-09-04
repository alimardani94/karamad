@extends('admin.layout.base')

@section('title', 'خانه')
@section('transaction', 'active menu-open')

@section('header')
    <section class="content-header">
        <h1>
            تراکنش ها <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">تراکنش ها</a></li>
            <li class="active">لیست تراکنش ها</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">لیست تراکنش ها</h3>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>کاربر</th>
                                <th>مقدار</th>
                                <th>تاریخ</th>
                                <th>وضعیت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>
                                        <a href="mailto:{{ $transaction->user->email }}">{{ $transaction->user->full_name }}</a>
                                    </td>
                                    <td>{{ number_format($transaction->amount) }}</td>
                                    <td>{{ jDate($transaction->created_at, 'dd MMMM yyyy - HH:mm') }}</td>
                                    <td>{{ $transaction->status() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{ $transactions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')

@endsection
