@extends('pages.auth.layout.base')

@section('title', 'ورود/نام‌نویسی')

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

        .intro-2 {
            background: url(http://localhost:8888/assets/img/auth/sign-in.jpg) center center no-repeat;
            background-size: cover;
        }

        input {
            text-align: center;
            direction: ltr;
        }

        input[type="text"]:-moz-placeholder {
            text-align: right;
        }

        input[type="text"]:-ms-input-placeholder {
            text-align: right;
        }

        input[type="text"]::-webkit-input-placeholder {
            text-align: right;
        }
    </style>
@endsection
@section('body')
    <header>
        @include('pages.auth.header.header')

        <section class="view intro-2">
            <div class="mask rgba-stylish-light h-100 d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-5">
                            <div class="card wow fadeIn" data-wow-delay="0.3s">
                                <div class="card-body">

                                    <div class="form-header primary-color">
                                        <h3 class="font-weight-500 m-0 text-center">
                                            <i class="fad fa-user fa-xs"></i>
                                            <span class="mb-2 align-top">ورود/نام‌نویسی</span>
                                        </h3>
                                    </div>

                                    <form id="request_form" action="{{ route('auth.otp.request')}}" method="post">
                                        <small class="mb-2">
                                            شماره همراه خود را وارد کنید و بر روی دکمه ارسال کلیک کنید.
                                        </small>
                                        <div class="md-form">
                                            <input type="text" id="cell" name="cell" class="form-control">
                                            <label for="cell">{{{ trans('validation.attributes.cell') }}}</label>
                                        </div>

                                        <div class="text-center">
                                            <button class="btn btn-primary btn-rounded">ارسال کد</button>
                                        </div>
                                    </form>
                                    <form id="submit_form" action="{{ route('auth.otp.submit')}}" method="post"
                                          style="display: none">
                                        <small class="mb-2">
                                            کد تایید ارسال شده را وارد نمایید.
                                        </small>
                                        <div class="md-form">
                                            <input type="text" id="code" name="code" class="form-control"
                                                   style="letter-spacing: 14px;">
                                            <label for="code">{{{ trans('validation.attributes.code') }}}</label>
                                        </div>
                                        <span id="time">60</span>

                                        <div class="text-center">
                                            <button class="btn btn-primary btn-rounded">ورود/نام‌نویسی</button>
                                        </div>
                                    </form>

                                    <div class="text-center">
                                        <hr class="mt-4 mb-1">
                                        <div class="inline-ul text-center d-flex justify-content-center">
                                            <a class="p-2 m-2 fa-lg tw-ic"><i class="fab fa-twitter black-text"></i></a>
                                            <a class="p-2 m-2 fa-lg li-ic"><i
                                                    class="fab fa-linkedin-in black-text"> </i></a>
                                            <a class="p-2 m-2 fa-lg ins-ic"><i
                                                    class="fab fa-instagram black-text"> </i></a>
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
        $(document).ready(function () {
            let timerVar;

            function showForm(form) {
                if (form === 'submit_form') {
                    $('#request_form').slideUp()
                    $('#submit_form').slideDown()
                } else {
                    $('#request_form').slideDown()
                    $('#submit_form').slideUp()
                }
            }

            function timer() {
                let t = $('#time');
                if (parseInt(t.html()) > 0) {
                    t.html(parseInt(t.html()) - 1);
                } else if (t.html() === '0') {
                    t.html('');
                    $('#code').val('')
                    showForm('request_form')
                }
            }

            $("#cell").inputmask("url", {
                mask: "0[*{1,10}]",
                greedy: false,
                clearMaskOnLostFocus: true,
                clearIncomplete: true,
                definitions: {
                    '*': {
                        validator: "[\u06F0-\u06F90-9\u0660-\u0669]",
                        cardinality: 1,
                        casing: "lower"
                    }
                }
            });

            $("#code").inputmask('999999');

            let request_form = $("#request_form");
            let submit_form = $("#submit_form");

            request_form.on('submit', function (e) {
                e.preventDefault();
                let validator = request_form.validate({
                    rules: {
                        cell: {
                            required: true,
                            minlength: 11,
                        },
                    },
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

                let valid = request_form.valid();
                if (!valid) {
                    validator.focusInvalid();
                } else {
                    $.ajax({
                        type: "POST",
                        url: request_form.attr('action'),
                        dataType: 'json',
                        data: request_form.serialize(),
                        success: function (response) {
                            showForm('submit_form')
                            $('#time').html(response['expires_after']);
                            toastr.success(response['message']);
                            clearInterval(timerVar);
                            timerVar = setInterval(timer, 1000);
                        },
                        error: function (error) {
                            switch (error.status) {
                                case 422:
                                    let errors = error['responseJSON']['errors'];

                                    for (let i in errors) {
                                        toastr.error(errors[i])
                                    }
                                    break;
                                default:
                                    // 500
                                    toastr.error(error['responseJSON']['message'])
                                    break;
                            }
                        }
                    });
                }
            })

            submit_form.on('submit', function (e) {
                e.preventDefault();
                let validator = submit_form.validate({
                    rules: {
                        code: {
                            required: true,
                            minlength: 6,
                        },
                    },
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

                let valid = submit_form.valid();
                if (!valid) {
                    validator.focusInvalid();
                } else {
                    $.ajax({
                        type: "POST",
                        url: submit_form.attr('action'),
                        dataType: 'json',
                        data: {
                            cell: $('#cell').val(),
                            code: $('#code').val(),
                        },
                        success: function (response) {
                            window.location = response['redirect'];
                        },
                        error: function (error) {
                            switch (error.status) {
                                case 422:
                                    let errors = error['responseJSON']['errors'];

                                    for (let i in errors) {
                                        toastr.error(errors[i])
                                    }
                                    break;
                                default:
                                    // 500
                                    toastr.error(error['responseJSON']['message'])
                                    break;
                            }
                        }
                    });
                }
            })
        });
    </script>
@endsection
