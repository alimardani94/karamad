@extends('pages.front.layout.base')

@section('title', 'درباره ما')

@section('header')
    @include('pages.header.header1', ['headerBG' => asset('assets/img/header/contact-us.jpg'), 'headerTitle' => 'تماس با ما'])
@stop

@section('style')

@endsection

@section('content')

    <section class="contact-section m-5">

        <!-- Form with header -->
        <div class="card">

            <div class="row">
                <div class="col-lg-8">

                    <div class="card-body form">
                        <form method="post">
                            @csrf
                            <h4 class="mt-4"><i class="far fa-envelope pl-2"></i>نظرات خود را برای ما ارسال کنید</h4>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="md-form mb-0">
                                        <i class="fal fa-user prefix"></i>
                                        <label for="name">نام</label>
                                        <input type="text" id="name" name="name"
                                               class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-form mb-0">
                                        <i class="fal fa-envelope prefix"></i>
                                        <label for="email">ایمیل</label>
                                        <input type="text" id="email" name="email"
                                               class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-form mb-0">
                                        <i class="fal fa-phone prefix"></i>
                                        <label for="cell">تلفن</label>
                                        <input type="text" id="cell" name="cell"
                                               class="form-control @error('phone') is-invalid @enderror">
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="md-form mb-0">
                                        <label for="body">پیام شما</label>
                                        <textarea type="text" id="body"
                                                  class="form-control md-textarea @error('body') is-invalid @enderror"
                                                  rows="3" name="body"></textarea>
                                        @error('body')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <button class="btn-floating btn-lg blue float-left" type="submit">
                                            <i class="fal fa-paper-plane"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="col-lg-4">

                    <div class="card-body contact text-center h-100 white-text">
                        <h3 class="my-4 pb-2">اطلاعات تماس</h3>
                        <ul class="text-lg-left list-unstyled ml-4">
                            <li>
                                <p>
                                    <i class="fas fa-map-marker-alt pl-2 mb-4"></i>
                                    تهران - نازی آباد
                                </p>
                            </li>

                            <li>
                                <p>
                                    <i class="fas fa-phone pl-2 mb-4"></i>
                                    0000 123 0912
                                </p>
                            </li>

                            <li>
                                <p>
                                    <i class="fas fa-envelope pl-2"></i>
                                    hooshcup@gmail.com
                                </p>
                            </li>

                        </ul>

                        <hr class="hr-light my-4">

                        <ul class="list-inline text-center list-unstyled">

                            <li class="list-inline-item">
                                <a class="p-2 fa-lg tw-ic">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>

                            <li class="list-inline-item">
                                <a class="p-2 fa-lg li-ic">
                                    <i class="fab fa-linkedin-in"> </i>
                                </a>
                            </li>

                            <li class="list-inline-item">
                                <a class="p-2 fa-lg ins-ic">
                                    <i class="fab fa-instagram"> </i>
                                </a>
                            </li>

                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')

@endsection

@section('footer')
    @include('pages.footer.footer1')
@stop
