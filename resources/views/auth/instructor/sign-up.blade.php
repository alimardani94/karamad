@extends('auth/layout.base')

@section('title', 'ثبت نام مدرس')

@section('class', 'register-page')

@section('style')
    <style>
        html,
        body,
        header,
        .view {
            height: 100%;
        }

        @media (min-width: 851px) and (max-width: 1440px) {
            html,
            body,
            header,
            .view {
                height: 850px;
            }
        }

        @media (min-width: 800px) and (max-width: 850px) {
            html,
            body,
            header,
            .view {
                height: 1000px;
            }
        }

        @media (min-width: 451px) and (max-width: 740px) {
            html,
            body,
            header,
            .view {
                height: 1200px;
            }
        }

        @media (max-width: 450px) {
            html,
            body,
            header,
            .view {
                height: 1400px;
            }
        }

        .register-page .intro-2 {
            background: url(http://localhost:8888/assets/img/auth/register.jpg) center center no-repeat;
            background-size: cover;
        }
    </style>
@endsection

@section('body')
    <header>
        @include('auth.header.header')

        <section class="view intro-2">
            <div class="mask rgba-gradient">
                <div class="container h-100 d-flex justify-content-center align-items-center">

                    <div class="row pt-3">

                        <div class="col-md-12">

                            <div class="card">
                                <div class="card-body">

                                    <h2 class="font-weight-bold my-4 text-center mb-5 mt-4 font-weight-bold">
                                        <strong>ثبت نام</strong>
                                    </h2>
                                    <hr>

                                    <div class="row mt-3">

                                        <div class="col-md-6 ml-lg-5 ml-md-3">
                                            <form id="signUpForm" method="post" class="text-center"
                                                  style="color: #757575;" action="{{route('auth.instructor.sign-up')}}">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="md-form">
                                                            <input type="text" id="name" name="name"
                                                                   class="form-control">
                                                            <label for="name">نام</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="md-form">
                                                            <input type="text" id="surname" name="surname"
                                                                   class="form-control">
                                                            <label for="surname">نام خانوادگی</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="md-form mt-0">
                                                    <input type="text" id="title" name="title" class="form-control">
                                                    <label for="title">عنوان (به طور مثال استاد دانشگاه تهران)</label>
                                                </div>

                                                <div class="md-form mt-0">
                                                    <input type="text" id="email" name="email" class="form-control">
                                                    <label for="email">ایمیل</label>
                                                </div>

                                                <div class="md-form">
                                                    <input type="text" id="cell" name="cell" class="form-control">
                                                    <label for="cell">شماره موبایل</label>
                                                </div>

                                                <div class="md-form">
                                                    <input type="password" id="password"
                                                           name="password" class="form-control"
                                                           aria-describedby="passwordHelpBlock">
                                                    <label for="password">گذرواژه</label>
                                                    <small id="passwordHelpBlock"
                                                           class="form-text text-muted mb-4">
                                                        حداقل ۸ کاراکتر باشد
                                                    </small>
                                                </div>

                                                <div class="form-check">
                                                    <input type="checkbox" name="terms"
                                                           class="form-check-input" id="terms">
                                                    <label class="form-check-label"
                                                           for="terms">
                                                        شرایط و ضوابط را میپذیرم.
                                                    </label>
                                                </div>

                                                <button
                                                    class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"
                                                    type="submit">ثبت نام
                                                </button>

                                                <hr class="mt-4">
                                                <div>
                                                    <span>قبلا ثبت نام کرده ام</span>
                                                    <a href="{{route('auth.sign-in')}}">ورود</a>
                                                </div>
                                            </form>

                                        </div>

                                        <div class="col-md-5 mt-4">

                                            <div class="row pb-4">
                                                <div class="col-2 col-lg-1">
                                                    <i class="fas fa-smile indigo-text fa-lg"></i>
                                                </div>
                                                <div class="col-10">
                                                    <h4 class="font-weight-bold mb-4">
                                                        <strong>راحتی</strong>
                                                    </h4>
                                                    <p class="">
                                                        شما به راحتی میتوانید از گنجینه بزرگ کلاس های آموزشی ما استفاده
                                                        کنید
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="row pb-4">
                                                <div class="col-2 col-lg-1">
                                                    <i class="fas fa-desktop deep-purple-text fa-lg"></i>
                                                </div>
                                                <div class="col-10">
                                                    <h4 class="font-weight-bold mb-4">
                                                        <strong>کلاس های آنلاین</strong>
                                                    </h4>
                                                    <p class="">
                                                        در کلاس های آنلاین شرکت کرده و در همان لحظه سوالات خود را از
                                                        معلم خود بپرسید
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="row pb-4">
                                                <div class="col-2 col-lg-1">
                                                    <i class="far fa-headphones purple-text fa-lg"></i>
                                                </div>
                                                <div class="col-10">
                                                    <h4 class="font-weight-bold mb-4">
                                                        <strong>پشتیبانی</strong>
                                                    </h4>
                                                    <p class="">
                                                        کارشناسان ما همواره آماده پاسخگویی به شما هستند
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
        let form = $("#signUpForm");
        let customRules = {
            name: "required",
            surname: "required",
            mobile: {
                required: true,
                minlength: 11,
                maxlength: 11
            },
            password: {
                required: true,
                minlength: 8
            },
            email: {
                required: true,
                email: true
            },
            terms: {
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
            if (!$('#terms').prop("checked")) {
                toastr.error('شرایط و ضوابط را بپذیرید')
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
