@extends('auth/layout.base')

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
    </style>
@endsection
@section('body')
    <header>
        @include('auth.header.header')

        <section class="view intro-2">
            <div class="mask rgba-stylish-light h-100 d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-5">
                            <div class="card wow fadeIn" data-wow-delay="0.3s">
                                <div class="card-body">

                                    <div class="form-header primary-color">
                                        <h1 class="font-weight-500 m-0 text-center">
                                            <i class="fad fa-user fa-xs"></i>
                                            <span class="mb-2 align-top">ورود/نام‌نویسی</span>
                                        </h1>
                                    </div>
                                    <form id="signInForm" action="{{ route('auth.sign-in')}}" method="post">
                                        @csrf
                                        <div class="md-form">
                                            <input type="text" id="cell" name="cell" class="form-control">
                                            <label for="cell">{{{ trans('validation.attributes.cell') }}}</label>
                                        </div>

                                        <div class="text-center">
                                            <button class="btn btn-primary btn-rounded">ورود</button>
                                            <hr class="mt-4">
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
        $(document).ready(function () {

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

            let form = $("#signInForm");
            let customRules = {
                cell: {
                    required: true,
                    minlength: 11,
                },
                password: {
                    required: true,
                    minlength: 6
                }
            };

            form.on('submit', function (e) {
                e.preventDefault();

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
                    $.ajax({
                        type: "POST",
                        url: form.attr('action'),
                        data: form.serialize(),
                        success: function (data) {
                            window.location = data.link;
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
