@extends('front/layout/base')

@section('title', 'دوره ها')

@section('header')
    @include('header.header1', ['headerBG' => asset('assets/img/slider/1.jpg'), 'headerTitle' => 'دوره ها'])
@stop

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/OwlCarousel2-2.3.4/assets/owl.carousel.min.css') }}">

@endsection
@section('content')
    <section>
        <div class="container">
            <div class="row my-4">
                @foreach($courses as $course)
                    <div class="col-md-3 my-2">
                        @include('front.layout.single_course', ['course' => $course])
                    </div>
                @endforeach
            </div>

            <div class="row mt-3">
                {{ $courses->links() }}
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('assets/vendor/OwlCarousel2-2.3.4/owl.carousel.min.js') }}"></script>

    <script>
        $('.owl-carousel').owlCarousel({
            animateOut: 'slideOutDown',
            animateIn: 'flipInX',
            stagePadding: 1,
            rtl: true,
            loop: false,
            margin: 2,
            nav: true,
            navText: [
                '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                '<i class="fa fa-angle-right" aria-hidden="true"></i>'
            ],
            navContainer: '.carousel-box .custom-nav',
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        })
    </script>
@endsection

@section('footer')
    @include('footer.footer1')
@stop
