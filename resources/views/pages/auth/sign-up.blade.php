@extends('pages.auth.layout.base')

@section('title', 'تکمیل نام‌نویسی')

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

        .intro-2 {
            background: url(http://localhost:8888/assets/img/auth/sign-up.jpg) center center no-repeat;
            background-size: cover;
        }
    </style>
@endsection

@section('body')
    <header>
        <section class="view intro-2">
            <div class="mask rgba-gradient">
                <div class="container h-100 d-flex justify-content-center align-items-center">

                    <div class="row pt-3">

                        <div class="col-md-12">

                            <div class="card">
                                <div class="card-body">

                                    <h3 class="font-weight-bold my-4 text-center mb-3 mt-2 font-weight-bold">
                                        <strong>تکمیل نام‌نویسی</strong>
                                    </h3>
                                    <hr class="mb-4">

                                    <div class="row mt-3">

                                        <div class="col-md-6 ml-lg-5 ml-md-3">
                                            <form id="signUpForm" method="post" class="text-center"
                                                  style="color: #757575;" action="{{ route('auth.sign-up') }}">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="md-form mt-2">
                                                            <input type="text" id="name" name="name"
                                                                   class="form-control">
                                                            <label
                                                                for="name">{{ trans('validation.attributes.name') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="md-form mt-2">
                                                            <input type="text" id="surname" name="surname"
                                                                   class="form-control">
                                                            <label
                                                                for="surname">{{ trans('validation.attributes.surname') }}</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="md-form mt-2">
                                                            <input type="text" id="email" name="email"
                                                                   class="form-control" autocomplete="off">
                                                            <label for="email">
                                                                {{ trans('validation.attributes.email') }}
                                                                <small>(دلخواه)</small>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="md-form mt-2">
                                                            <select name="province" id="province"
                                                                    class="mdb-select"
                                                                    required>
                                                                <option value="" disabled selected>
                                                                    {{ trans('validation.attributes.province') }}
                                                                </option>
                                                                @foreach($provinces as $province)
                                                                    <option value="{{ $province->id }}">
                                                                        {{ $province->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <label for="province"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="md-form mt-2">
                                                            <select name="city" id="city" class="mdb-select"
                                                                    searchable="جستجو کنید"
                                                                    required>
                                                                <option value="" disabled selected>
                                                                    {{ trans('validation.attributes.city') }}
                                                                </option>
                                                            </select>
                                                            <label for="city"></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-check mt-3 mb-3">
                                                    <input type="checkbox" name="type" id="type"
                                                           class="form-check-input" value="student">
                                                    <label class="form-check-label" for="type">
                                                        دانش‌آموز هستم.
                                                    </label>
                                                </div>

                                                <div class="form-row" id="student_box" style="display: none">
                                                    <div class="col">
                                                        <div class="md-form mt-2">
                                                            <input type="text" id="school" name="school"
                                                                   class="form-control">
                                                            <label for="school">
                                                                {{ trans('validation.attributes.school') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="md-form mt-2">
                                                            <select name="grade" id="grade" class="mdb-select">
                                                                <option value="" disabled selected>
                                                                    {{ trans('validation.attributes.grade') }}
                                                                </option>
                                                                @foreach($grades as $grade => $key)
                                                                    <option value="{{ $key }}">{{ $grade }}</option>
                                                                @endforeach
                                                            </select>
                                                            <label for="grade"></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-check mt-3">
                                                    <input type="checkbox" name="terms"
                                                           class="form-check-input" id="terms">
                                                    <label class="form-check-label"
                                                           for="terms">
                                                        شرایط و ضوابط را میپذیرم.
                                                    </label>
                                                </div>

                                                <button
                                                    class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"
                                                    type="submit">نام‌نویسی
                                                </button>
                                            </form>

                                        </div>

                                        <div class="col-md-5 mt-4">

                                            <div class="row pb-4">
                                                <div class="col-2">
                                                    <i class="fad fa-desktop indigo-text fa-2x"></i>
                                                </div>
                                                <div class="col-10">
                                                    <h4 class="font-weight-bold mb-4">
                                                        <strong>کلاس‌های آموزشی</strong>
                                                    </h4>
                                                    <p class="">
                                                        شما به راحتی می‌توانید از گنجینه بزرگ کلاس های آموزشی ما استفاده
                                                        کنید
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="row pb-4">
                                                <div class="col-2">
                                                    <i class="fad fa-shopping-cart deep-purple-text fa-2x"></i>
                                                </div>
                                                <div class="col-10">
                                                    <h4 class="font-weight-bold mb-4">
                                                        <strong>فروشگاه</strong>
                                                    </h4>
                                                    <p class="">
                                                        محصولات خود را بفروشید و یا محصولات بی‌نظیر دانش‌آموزان این
                                                        سرزمین را بخریذ
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="row pb-4">
                                                <div class="col-2">
                                                    <i class="fad fa-headphones purple-text fa-2x"></i>
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
        let getCitiesUrl = '{{ route('cities') }}';

        function getCities(province, selected = '') {
            if (province === '0' || province === null || province === '') {
                return false;
            }

            $.ajax({
                url: getCitiesUrl,
                type: 'GET',
                dataType: 'json',
                data: {
                    province: province,
                },
                success: function (data) {
                    let citySelect = $("#city");
                    let provinceSelect = $("#province");
                    citySelect.val('').attr('disabled', true);
                    provinceSelect.attr('disabled', true);

                    citySelect.html($('<option>', {
                        value: '',
                        text: 'شهر',
                        disabled: 'disabled',
                        selected: 'selected',
                    }));
                    $.each(data, function (i, item) {
                        let selectedTxt = false;
                        if (i === selected) {
                            selectedTxt = 'selected';
                        }

                        citySelect.append($('<option>', {
                            value: i,
                            text: item,
                            selected: selectedTxt
                        }));
                    });

                    citySelect.attr('disabled', false);
                    provinceSelect.attr('disabled', false);

                    citySelect.materialSelect({destroy: true});
                    citySelect.materialSelect();
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
    </script>
    <script>
        $(document).ready(function () {

            $('.mdb-select').materialSelect();

            $('#province').on('change', function () {
                getCities(this.value);
            }).trigger('change')

            $('#type').on('change', function () {
                if (this.checked) {
                    $('#student_box').slideDown();
                } else {
                    $('#student_box').slideUp();
                }
            })

            let form = $("#signUpForm");
            let customRules = {
                name: {
                    required: true,
                    minlength: 3,
                },
                surname: {
                    required: true,
                    minlength: 3,
                },
                email: {
                    required: false,
                    email: true
                },
                province: {
                    required: true,
                },
                city: {
                    required: true,
                },
                school: {
                    required: function (element) {
                        return $("#type").is(':checked');
                    }
                },
                grade: {
                    required: function (element) {
                        return $("#type").is(':checked');
                    }
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

                if ($('#terms').prop("checked") === false) {
                    toastr.error('شرایط و ضوابط را بپذیرید')
                }

                if (!error) {
                    $.ajax({
                        type: "POST",
                        url: form.attr('action'),
                        data: form.serialize(),
                        success: function (data) {
                            // toastr.success(data.message);
                            window.location = data['redirect'];
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
            });
        });
    </script>
@endsection
