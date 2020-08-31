@extends('admin.layout.base')

@section('title', 'خانه')
@section('product', 'active menu-open')
@section('product1', 'active')

@section('header')
    <section class="content-header">
        <h1>
            محصولات <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
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
                        <a href="{{ route('admin.products.create')}}" class="btn btn-primary btn-flat pull-left">افزودن
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
                                <th>تاریخ ایجاد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->type()}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->quantity}}</td>

                                    <td>{{jDate($product->created_at, 'dd MMMM yyyy - HH:mm')}}</td>
                                    <td>
                                        <a href="{{ route('admin.products.edit', ['product' => $product->id])}}" type="button" class="btn btn-block btn-primary btn-xs">ویرایش محصول
                                        </a>
                                        <a type="button" class="btn btn-block btn-danger btn-xs"
                                           onclick="removeProduct({{$product->id}})">حذف محصول</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        function removeProduct(id) {
            let url = "{{ route('admin.products.destroy', '')}}/" + id
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
                                'محصول با موفقیت حذف شد',
                                '',
                                'success'
                            )
                            window.location.reload();
                        },
                        error: function (e) {
                            if (e.responseJSON.message != undefined) {
                                toastr.error(e.responseJSON.message);
                            } else {
                                toastr.error();
                            }
                        }
                    });
                }
            })
        }
    </script>
@endsection
