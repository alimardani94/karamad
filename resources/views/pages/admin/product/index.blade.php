@extends('pages.admin.layout.base')

@section('title', 'خانه')
@section('product', 'active menu-open')
@section('product1', 'active')

@section('header')
    <section class="content-header">
        <h1>
            محصولات <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">محصولات</a></li>
            <li class="active">لیست محصولات</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">لیست محصولات</h3>
                        <a href="{{ route('admin.shop.products.create') }}" class="btn btn-primary btn-flat pull-left">افزودن
                            محصول جدید</a>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>نوع</th>
                                <th>قیمت</th>
                                <th>موجودی</th>
                                <th>تاریخ</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        <a href="{{ route('shop.product', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                            {{ $product->name }}
                                        </a>
                                    </td>
                                    <td>{{ $product->type() }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->quantity }}</td>

                                    <td>{{jDate($product->created_at, 'dd MMMM yyyy - HH:mm') }}</td>
                                    <td class="{{ ProductStatus::keyOf($product->status) }}">{{ $product->status()}}</td>
                                    <td>
                                        @if($product->status != ProductStatus::REJECTED)
                                            <a type="button" class="reject-product-btn btn btn-block btn-warning btn-xs"
                                               data-url="{{ route('admin.shop.products.change-status', ['product' => $product->id ])}}">
                                                عدم‌تایید کردن
                                            </a>
                                        @endif
                                        @if($product->status != ProductStatus::CONFIRMED)
                                            <a type="button"
                                               class="confirm-product-btn btn btn-block btn-success btn-xs"
                                               data-url="{{ route('admin.shop.products.change-status', ['product' => $product->id ])}}">
                                                تابید
                                            </a>
                                        @endif
                                        <a href="{{ route('admin.shop.products.edit', ['product' => $product->id]) }}"
                                           type="button" class="btn btn-block btn-primary btn-xs">
                                            ویرایش محصول
                                        </a>
                                        <a type="button" class="btn btn-block btn-danger btn-xs"
                                           onclick="removeProduct({{ $product->id }})">حذف محصول</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        let statuses = @json(ProductStatus::all())
    </script>
    <script>
        function removeProduct(id) {
            let url = "{{ route('admin.shop.products.destroy', '') }}/" + id
            Swal.fire({
                title: 'آیا محصول حذف شود؟',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        success: function (response) {
                            Swal.fire(
                                response['message'],
                                '',
                                'success'
                            )
                            window.location.reload();
                        },
                        error: function (error) {
                            switch (error.status) {
                                case 422:
                                    let errors = error['responseJSON']['errors'];

                                    for (let i in errors) {
                                        toastr.error(errors[i])
                                    }
                                    break;
                                default:
                                    // 500
                                    toastr.error(error['responseJSON']['message'])
                                    break;
                            }
                        }
                    });
                }
            })
        }

        $('.reject-product-btn').on('click', function () {
            let url = $(this).attr('data-url');

            Swal.fire({
                title: 'آیا محصول عدم‌تایید شود؟',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        dataType: 'json',
                        data: {
                            'status': statuses['REJECTED'],
                        },
                        success: function (response) {
                            Swal.fire(
                                response['message'],
                                '',
                                'success'
                            )
                            window.location.reload();
                        },
                        error: function (error) {
                            switch (error.status) {
                                case 422:
                                    let errors = error['responseJSON']['errors'];

                                    for (let i in errors) {
                                        toastr.error(errors[i])
                                    }
                                    break;
                                default:
                                    // 500
                                    toastr.error(error['responseJSON']['message'])
                                    break;
                            }
                        }
                    });
                }
            })
        });

        $('.confirm-product-btn').on('click', function () {
            let url = $(this).attr('data-url');

            Swal.fire({
                title: 'آیا محصول ‌تایید شود؟',
                text: "",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        dataType: 'json',
                        data: {
                            'status': statuses['CONFIRMED'],
                        },
                        success: function (response) {
                            Swal.fire(
                                response['message'],
                                '',
                                'success'
                            )
                            window.location.reload();
                        },
                        error: function (error) {
                            switch (error.status) {
                                case 422:
                                    let errors = error['responseJSON']['errors'];

                                    for (let i in errors) {
                                        toastr.error(errors[i])
                                    }
                                    break;
                                default:
                                    // 500
                                    toastr.error(error['responseJSON']['message'])
                                    break;
                            }
                        }
                    });
                }
            })
        });
    </script>
@endsection
