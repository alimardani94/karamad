@extends('pages.admin.layout.base')

@section('title', 'خانه')

@section( 'course.category', 'active menu-open')
@section( 'course.category1', 'active')

@section('header')
    <section class="content-header">
        <h1>
            دسته بندی ها <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">دسته بندی ها</a></li>
            <li class="active">لیست دسته بندی ها</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">لیست دسته بندی ها</h3>
                        <a href="{{ route('admin.course.categories.create') }}"
                           class="btn btn-primary btn-flat pull-left">افزودن
                            دسته بندی جدید</a>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>نام</th>
                                <th>والد</th>
                                <th>تاریخ ایجاد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name}}</td>
                                    <td>{{ $category->parent ? $category->parent->name : 'ندارد (دسته اصلی)' }}</td>
                                    <td>{{jDate($category->created_at, 'dd MMMM yyyy - HH:mm') }}</td>
                                    <td>
                                        <a href="{{ route('admin.course.categories.edit', ['category' => $category->id]) }}"
                                           type="button" class="btn btn-block btn-primary btn-xs">
                                            ویرایش دسته بندی
                                        </a>
                                        <a type="button" class="btn btn-block btn-danger btn-xs"
                                           onclick="removeCategory({{ $category->id}})">
                                            حذف دسته بندی
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        function removeCategory(id) {
            let url = "{{ route('admin.course.categories.destroy', '') }}/" + id
            Swal.fire({
                title: 'آیا دسته بندی حذف شود؟',
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
                                'دسته بندی با موفقیت حذف شد',
                                '',
                                'success'
                            )
                            window.location.reload();
                        },
                        error: function (e) {
                            if (e['responseJSON']['message'] !== undefined) {
                                toastr.error(e['responseJSON']['message']);
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
