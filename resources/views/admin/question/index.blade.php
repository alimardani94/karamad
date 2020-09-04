@extends('admin.layout.base')

@section('title', 'خانه')
@section('question', 'active menu-open')
@section('question1', 'active')

@section('header')
    <section class="content-header">
        <h1>
            سوالات <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">سوالات</a></li>
            <li class="active">لیست سوالات</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">لیست سوالات</h3>
                        @if(request()->get('exam'))
                            <a href="{{route('admin.questions.create', ['exam' => request()->get('exam')])}}"
                               class="btn btn-primary btn-flat pull-left">افزودن
                                سوال جدید</a>
                        @else
                            <a href="{{route('admin.questions.create')}}" class="btn btn-primary btn-flat pull-left">افزودن
                                سوال جدید</a>
                        @endif
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>سوال</th>
                                <th>گزینه ۱</th>
                                <th>گزینه ۲</th>
                                <th>گزینه ۳</th>
                                <th>گزینه ۴</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($questions as $question)
                                <tr>
                                    <td>{!! $question->title !!}</td>
                                    <td style="{{ ($question->answer == 'a') ? 'color:green' : ''}}">{!! $question->a !!}</td>
                                    <td style="{{ ($question->answer == 'b') ? 'color:green' : ''}}">{!! $question->b !!}</td>
                                    <td style="{{ ($question->answer == 'c') ? 'color:green' : ''}}">{!! $question->c !!}</td>
                                    <td style="{{ ($question->answer == 'd') ? 'color:green' : ''}}">{!! $question->d !!}</td>
                                    <td>
                                        <a href="{{ route('admin.questions.edit', ['question' => $question->id])}}"
                                           type="button" class="btn btn-block btn-primary btn-xs">
                                            ویرایش سوال
                                        </a>
                                        <a type="button" class="btn btn-block btn-danger btn-xs"
                                           onclick="removeQuestion({{$question->id}})">
                                            حذف سوال
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{ $questions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        function removeQuestion(id) {
            let url = "{{route('admin.questions.destroy', '')}}/" + id
            Swal.fire({
                title: 'آیا سوال حذف شود؟',
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
                                'سوال با موفقیت حذف شد',
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
