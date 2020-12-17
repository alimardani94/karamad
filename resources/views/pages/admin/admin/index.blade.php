@extends('pages.admin.layout.base')

@section('title', 'خانه')
@section('admin', 'active menu-open')
@section('admin1', 'active')

@section('header')
    <section class="content-header">
        <h1>
            مدیران <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">مدیران</a></li>
            <li class="active">لیست مدیران</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">لیست مدیران</h3>
                        <a href="{{ route('admin.admins.create') }}" class="btn btn-primary btn-flat pull-left">
                            افزودن مدیر جدید
                        </a>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>نام</th>
                                <th>تاریخ ایجاد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td>{{ $admin->user->full_name}}</td>
                                    <td>{{jDate($admin->created_at, 'dd MMMM yyyy - HH:mm') }}</td>
                                    <td>
                                        <a href="{{ route('admin.admins.edit', ['admin' => $admin->id]) }}" type="button" class="btn btn-block btn-primary btn-xs">ویرایش مدیر
                                        </a>
                                        <a type="button" class="btn btn-block btn-danger btn-xs"
                                           onclick="removeAdmin({{ $admin->id}})">حذف مدیر</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{ $admins->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        function removeAdmin(id) {
            let url = "{{ route('admin.admins.destroy', '') }}/" + id
            Swal.fire({
                title: 'آیا مدیر حذف شود؟',
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
                                'مدیر با موفقیت حذف شد',
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
