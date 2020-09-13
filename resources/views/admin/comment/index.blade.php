@extends('admin.layout.base')

@section('title', 'خانه')
@section('comment', 'active menu-open')
@section('comment1', 'active')

@section('header')
    <section class="content-header">
        <h1>
            دیدگاه ها <small>لیست</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">دیدگاه ها</a></li>
            <li class="active">لیست دیدگاه ها</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">لیست دیدگاه ها</h3>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>متن</th>
                                <th>برای</th>
                                <th>نویسنده</th>
                                <th>تاریخ ایجاد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{ $comment->body }}</td>
                                    <td>
                                        <a href="{{ route('posts.show', ['post' => $comment->commentable_id, 'slug' => $comment->commentable->title]) }}">
                                            {{ $comment->commentable->title }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $comment->email }}">{{ $comment->name }}</a>
                                    </td>
                                    <td>{{ jDate($comment->created_at, 'dd MMMM yyyy - HH:mm') }}</td>
                                    <td>
                                        <a type="button" class="btn btn-block btn-danger btn-xs"
                                           onclick="removePost({{ $comment->id }})">حذف دیدگاه</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{ $comments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        function removePost(id) {
            let url = "{{ route('admin.posts.comments.destroy', '') }}/" + id
            Swal.fire({
                title: 'آیا دیدگاه حذف شود؟',
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
                                'دیدگاه با موفقیت حذف شد',
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
