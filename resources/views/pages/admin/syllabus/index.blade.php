@extends('pages.admin.layout.base')

@section('title', 'خانه')
@section('syllabus', 'active menu-open')
@section('syllabus1', 'active')

@section('header')
    <section class="content-header">
        <h1>
            جلسه ها <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">جلسه ها</a></li>
            <li class="active">لیست جلسه ها</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">لیست جلسه ها</h3>
                        @if(request()->get('course'))
                            <a href="{{ route('admin.syllabuses.create', ['course' => request()->get('course')]) }}"
                               class="btn btn-primary btn-flat pull-left">
                                افزودن
                                جلسه جدید
                            </a>
                        @else
                            <a href="{{ route('admin.syllabuses.create') }}" class="btn btn-primary btn-flat pull-left">
                                افزودن
                                جلسه جدید
                            </a>
                        @endif
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>دوره</th>
                                <th>نوع</th>
                                <th>تاریخ ایجاد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($syllabuses as $syllabus)
                                <tr>
                                    <td>{{ $syllabus->title}}</td>
                                    <td>{{ $syllabus->course->title}}</td>
                                    <td>{{ $syllabus->type() }}</td>
                                    <td>{{jDate($syllabus->created_at, 'dd MMMM yyyy - HH:mm') }}</td>
                                    <td>
                                        <a href="{{ route('admin.syllabuses.edit', ['syllabus' => $syllabus->id]) }}"
                                           type="button" class="btn btn-block btn-primary btn-xs">ویرایش جلسه
                                        </a>
                                        <a onclick="removeSyllabus({{ $syllabus->id}})" type="button"
                                           class="btn btn-block btn-danger btn-xs">حذف جلسه</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{ $syllabuses->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        function removeSyllabus(id) {
            let url = "{{ route('admin.syllabuses.destroy', '') }}/" + id
            Swal.fire({
                title: 'آیا جلسه حذف شود؟',
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
                                'جلسه با موفقیت حذف شد',
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
