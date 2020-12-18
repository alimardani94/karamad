@extends('pages.admin.layout.base')

@section('title', 'خانه')
@section('instructor', 'active menu-open')
@section('instructor1', 'active')

@section('header')
    <section class="content-header">
        <h1>
            مدرسان <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home') }}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">مدرسان</a></li>
            <li class="active">لیست مدرسان</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">لیست مدرسان</h3>
                        <a href="{{ route('admin.course.instructors.create') }}" class="btn btn-primary btn-flat pull-left">افزودن
                            مدرس جدید</a>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>نام</th>
                                <th>توضیحات</th>
                                <th>نوع</th>
                                <th>تاریخ ایجاد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($instructors as $instructor)
                                <tr>
                                    <td>{{ $instructor->name}}</td>
                                    <td>{{substr($instructor->about,0,200) }}</td>
                                    <td>{{ $instructor->type() }}</td>
                                    <td>{{jDate($instructor->created_at, 'dd MMMM yyyy - HH:mm') }}</td>
                                    <td>
                                        @if($instructor->type = \App\Enums\Instructor\InstructorType::NotUser)
                                            <a href="{{  route('admin.course.instructors.edit', ['instructor' => $instructor->id]) }}"
                                               type="button" class="btn btn-block btn-primary btn-xs">
                                                ویرایش مدرس
                                            </a>
                                            <a type="button" class="btn btn-block btn-danger btn-xs"
                                               onclick="removeInstructor({{ $instructor->id}})">
                                                حذف مدرس
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{ $instructors->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        function removeInstructor(id) {
            let url = "{{ route('admin.course.instructors.destroy', '') }}/" + id
            Swal.fire({
                title: 'آیا مدرس حذف شود؟',
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
                                'مدرس با موفقیت حذف شد',
                                '',
                                'success'
                            )
                            window.location.reload();
                        },
                        error: function (e) {
                            console.log(e, e.responseJSON.message)
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
