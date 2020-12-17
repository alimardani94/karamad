@extends('pages.front.layout.base')

@section('title', 'جستجو دوره')

@section('header')
    @include('pages.header.header1', ['headerBG' => asset('assets/img/slider/2.jpg')])
@stop

@section('style')
@endsection
@section('content')
    <section>
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12">
                    @if($courses->count())
                        <div class="row text-center py-4 mt-4">
                            <h2 class="font-weight-bold mx-auto">دوره های یافته شده</h2>
                        </div>
                        <div class="row row-cols-1 row-cols-md-4">
                            @foreach($courses as $course)
                                <div class="col my-3">
                                    @include('pages.front.layout.single_course', ['course' => $course])
                                </div>
                            @endforeach
                        </div>
                        <div class="row mb-3 mt-5">
                            <div class="col-12">
                                {{ $courses->links() }}
                            </div>
                        </div>
                    @endif
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
