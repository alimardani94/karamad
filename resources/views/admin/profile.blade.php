@extends('admin.layout.base')

@section('title', 'پروفایل')

@section('header')
    <section class="content-header">
        <h1>
            خانه
            <br>
            <small>اطلاعات عمومی</small>
        </h1>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form method="post" action="{{ route('admin.profiles.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-header"></div>
                        <div class="box-body">
                            <div class="row" style="display: flex;justify-content: center">
                                <img id="image_view" src="{{ $user->image }}" class="img-circle" alt="profile image"
                                     width="100" style=""/>
                            </div>
                            <div class="row" style="display: flex;justify-content: center">
                                <div class="col-md-6 mt-2">
                                    <label for="image"><small>در صورتی که میخواهید تغییر دهید، انتخاب کنید</small></label>
                                    <div class="form-group">
                                        <label class="form-control">
                                            <span> انتخاب کنید ... </span>
                                            <input type="file" class="custom-file-input" accept="image/*"
                                                   id="image" name="image" value="{{ old('image') }}"
                                                   hidden>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">نام</label>
                                        <input type="text" class="form-control" id="name" placeholder="نام"
                                               value="{{ old('name', $user->name) }}" name="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="surname">نام خانوادگی</label>
                                        <input type="text" class="form-control" id="surname" placeholder="نام خانوادگی"
                                               value="{{ old('surname', $user->surname)}}" name="surname">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">ایمیل</label>
                                        <input type="text" class="form-control" id="email" placeholder="ایمیل"
                                               value="{{ old('email', $user->email)}}" name="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cell">موبایل</label>
                                        <input type="text" class="form-control" id="cell" placeholder="موبایل"
                                               value="{{ old('cell', $user->cell)}}" name="cell">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">ویرایش</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image_view').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function () {
            readURL(this);
        });
    </script>
@endsection

