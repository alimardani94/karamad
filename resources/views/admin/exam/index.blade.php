@extends('admin.layout.base')

@section('title', 'خانه')
@section('exam', 'active menu-open')
@section('exam1', 'active')

@section('header')
    <section class="content-header">
        <h1>
            آزمون ها <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">آزمون ها</a></li>
            <li class="active">لیست آزمون ها</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">لیست آزمون ها</h3>
{{--                        <a href="{{ route('admin.exams.create')}}" class="btn btn-primary btn-flat pull-left">افزودن--}}
{{--                            آزمون جدید</a>--}}
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>نام</th>
                                <th>توضیحات</th>
                                <th>تعداد سوالات</th>
                                <th>تاریخ ایجاد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($exams as $exam)
                                <tr>
                                    <td>{{$exam->title}}</td>
                                    <td>{{$exam->description}}</td>
                                    <td>{{$exam->questions_count}}</td>
                                    <td>{{jDate($exam->created_at, 'dd MMMM yyyy - HH:mm')}}</td>
                                    <td>
                                        <a href="{{ route('admin.questions.create', ['exam' => $exam->id])}}"
                                           type="button" class="btn btn-block btn-default btn-xs">افزودن سوال</a>
                                        <a href="{{ route('admin.questions.index', ['exam' => $exam->id])}}"
                                           type="button" class="btn btn-block btn-info btn-xs">لیست سوالات</a>

                                        @if(!$exam->syllabus)
                                            <a href="{{ route('admin.exams.edit', ['exam' => $exam->id])}}"
                                               type="button" class="btn btn-block btn-primary btn-xs">
                                                ویرایش آزمون
                                            </a>
                                            <a type="button" class="btn btn-block btn-danger btn-xs"
                                               onclick="removeExam({{$exam->id}})">
                                                حذف آزمون
                                            </a>
                                        @endif
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
        function removeExam(id) {
            let url = "{{ route('admin.exams.destroy', '')}}/" + id
            Swal.fire({
                title: 'آیا آزمون حذف شود؟',
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
                                'آزمون با موفقیت حذف شد',
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
