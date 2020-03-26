@extends('auth/layout.base')

@section('title', 'ورود')

@section('class', 'login-page')

@section('style')
    <style>
        html,
        body,
        header,
        .view {
            height: 100%;
        }

        @media (min-width: 560px) and (max-width: 740px) {
            html,
            body,
            header,
            .view {
                height: 650px;
            }
        }

        @media (min-width: 800px) and (max-width: 850px) {
            html,
            body,
            header,
            .view {
                height: 650px;
            }
        }

        .login-page .intro-2 {
            background: url(http://localhost:8888/assets/img/auth/Artificial-intelligence.jpg) center center no-repeat;
            background-size: cover;
        }
    </style>
@endsection
@section('body')
    <header>
        @include('auth.header.header')

        <section class="view intro-2">
            <div class="mask rgba-stylish-strong h-100 d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-5">
                            <div class="card wow fadeIn" data-wow-delay="0.3s">
                                <div class="card-body">

                                    <div class="form-header info-color-dark">
                                        <h3 class="font-weight-500 my-2 py-1"><i class="fas fa-user mx-3"></i>ورود</h3>
                                    </div>
                                    <form id="signInForm" action="{{route('auth.sign-in')}}" method="post">
                                        @csrf
                                        <div class="md-form">
                                            <input type="text" id="email" name="login" class="form-control">
                                            <label for="email">ایمیل</label>
                                        </div>

                                        <div class="md-form">
                                            <input type="password" id="password" name="password" class="form-control">
                                            <label for="password">گذرواژه</label>
                                        </div>

                                        <div class="text-center">
                                            <button class="btn blue-gradient btn-lg">ورود</button>
                                            <hr class="mt-4">
                                            <div>
                                                <span>هنوز ثبت نام نکرده ام</span>
                                                <a href="{{route('auth.sign-up')}}">ثبت نام</a>
                                            </div>
                                            <div class="inline-ul text-center d-flex justify-content-center">
                                                <hr class="mt-1">
                                                <a class="p-2 m-2 fa-lg tw-ic"><i class="fab fa-twitter black-text"></i></a>
                                                <a class="p-2 m-2 fa-lg li-ic"><i
                                                        class="fab fa-linkedin-in black-text"> </i></a>
                                                <a class="p-2 m-2 fa-lg ins-ic"><i
                                                        class="fab fa-instagram black-text"> </i></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </header>

@endsection


@section('js')
    <script>
        let form = $("#signInForm");
        let customRules = {
            login: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 1
            }
        };

        form.on('submit', function (e) {
            e.preventDefault();
            let error = true;
            let validator = form.validate({
                rules: customRules,
                highlight: function (element) {
                    $(element).addClass('invalid').removeClass('valid');
                },
                unhighlight: function (element) {
                    $(element).removeClass('invalid').addClass('valid');
                },
                errorPlacement: function (error, element) {
                    // $("label[for='" + $(element).attr('id') + "']").attr('data-error', error.text());
                },
            });

            let valid = form.valid();
            if (!valid) {
                validator.focusInvalid();
            } else {
                error = false;
            }

            if (!error) {
                $.ajax({
                    type: "POST",
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function (data) {
                        toastr.success(data.message);
                        window.location = data.link;
                    },
                    error: function (data) {
                        let errors = data.responseJSON.errors;
                        for (let i in errors) {
                            toastr.error(errors[i]);
                        }
                    }
                });
            }
        })
    </script>
@endsection
