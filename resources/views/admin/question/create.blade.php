@extends('admin.layout.base')

@section('title', 'خانه')
@section('question', 'active menu-open')
@section('question2', 'active')

@section('style')
@endsection

@section('header')
    <section class="content-header">
        <h1>
            @if(request()->get('exam'))
                <span>افزودن سوال شماره</span>
                <strong>{{$number}}</strong>
            @else
                افزودن سوال
            @endif
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
            <li><a href="#">سوال ها</a></li>
            <li class="active">افزودن سوال</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form method="post" action="{{route('admin.questions.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-header"></div>
                        <div class="box-body">
                            @if(!$exam)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exam">انتخاب آزمون</label>
                                            <select type="text" class="form-control select2" id="exam"
                                                    name="exam">
                                                @foreach($exams as $exam)
                                                    <option value="{{ $exam->id }}"
                                                        {{old('exam') == $exam->id ? 'selected':''}}>
                                                        {{ $exam->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @else
                                <label>
                                    <input name="exam" value="{{$exam->id}}" hidden>
                                </label>
                            @endif

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="title">سوال</label>
                                    <textarea id="title" name="title"
                                              class="form-control">{!! old('title') !!}</textarea>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="answer">گزینه صحیح</label>
                                        <select type="text" class="form-control select2" id="answer" name="answer">
                                            <option disabled selected>انتخاب کنید</option>
                                            <option value="a" {{ old('answer') == 'a' ? 'selected' : ''}}>گزینه 1
                                            </option>
                                            <option value="b" {{ old('answer') == 'b' ? 'selected' : ''}}>گزینه 2
                                            </option>
                                            <option value="c" {{ old('answer') == 'c' ? 'selected' : ''}}>گزینه 3
                                            </option>
                                            <option value="d" {{ old('answer') == 'd' ? 'selected' : ''}}>گزینه 4
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="answer_a">گزینه ۱</label>
                                    <textarea id="answer_a" name="a" class="form-control">{!! old('a') !!}</textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="answer_b">گزینه ۲</label>
                                    <textarea id="answer_b" name="b" class="form-control">{!! old('b') !!}</textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="answer_c">گزینه ۳</label>
                                    <textarea id="answer_c" name="c" class="form-control">{!! old('c') !!}</textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="answer_d">گزینه ۴</label>
                                    <textarea id="answer_d" name="d" class="form-control">{!! old('d') !!}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">افزودن سوال جدید</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('assets/admin/adminLTE/components/tinymce/tinymce.min.js')}}"></script>
    <script>
        tinymce.init({
            selector: 'textarea#title',
            plugins: 'advlist autolink link lists preview table code pagebreak formula image',
            menubar: false,
            language: 'fa',
            height: 100,
            relative_urls: false,
            toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link image | formula',
        });

        tinymce.init({
            selector: 'textarea#answer_a',
            plugins: 'advlist autolink link lists preview table code pagebreak formula image',
            menubar: false,
            language: 'fa',
            height: 120,
            relative_urls: false,
            toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link image | formula',
        });
        tinymce.init({
            selector: 'textarea#answer_b',
            plugins: 'advlist autolink link lists preview table code pagebreak formula image',
            menubar: false,
            language: 'fa',
            height: 100,
            relative_urls: false,
            toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link image | formula',
        });
        tinymce.init({
            selector: 'textarea#answer_c',
            plugins: 'advlist autolink link lists preview table code pagebreak formula image',
            menubar: false,
            language: 'fa',
            height: 100,
            relative_urls: false,
            toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link image | formula',
        });
        tinymce.init({
            selector: 'textarea#answer_d',
            plugins: 'advlist autolink link lists preview table code pagebreak formula image',
            menubar: false,
            language: 'fa',
            height: 100,
            relative_urls: false,
            toolbar: 'undo redo | removeformat preview code | fontsizeselect bullist numlist | alignleft aligncenter alignright alignjustify | bold italic | pagebreak table link image | formula',
        });
    </script>
@endsection
