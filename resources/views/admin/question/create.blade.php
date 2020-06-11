@extends('admin.layout.base')

@section('title', 'خانه')
@section('exam', 'active menu-open')
@section('exam2', 'active')

@section('style')
@endsection

@section('header')
    <section class="content-header">
        <h1>
            افزودن سوال جدید
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
                                            <label for="exam">انتخاب دوره</label>
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
                                    <div class="form-group">
                                        <label for="title">عنوان</label>
                                        <input type="text" class="form-control" id="title" placeholder="عنوان"
                                               value="{{old('title')}}" name="title">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="description">توضیحات </label>
                                    <textarea id="description" name="description"
                                              class="form-control">{{old('description')}}</textarea>
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
@endsection
