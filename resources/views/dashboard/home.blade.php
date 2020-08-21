@extends('dashboard/layout/base')

@section('title', 'داشبورد')

@section('header')
    @include('header.header2')
@stop

@section('content')

    <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active h-100" id="v-pills-home"
             role="tabpanel" aria-labelledby="v-pills-home-tab">
            <div class="card-title">داشبورد</div>
            <div class="card-body">

                1
            </div>
        </div>
        @if($authUser->isInstructor())
            <div class="tab-pane fade" id="v-pills-add-course" role="tabpanel"
                 aria-labelledby="v-pills-add-course-tab">
                <div class="card-title">افزودن دوره</div>
                <div class="card-body">

                    3
                </div>
            </div>
        @endif
        <div class="tab-pane fade" id="v-pills-courses" role="tabpanel"
             aria-labelledby="v-pills-courses-tab">
            <div class="card-title">دوره های من</div>
            <div class="card-body">

                3
            </div>
        </div>

        <div class="tab-pane fade" id="v-pills-online-courses" role="tabpanel"
             aria-labelledby="v-pills-online-courses-tab">
            <div class="card-title">کلاس آنلاین</div>
            <div class="card-body">
                <ul>

                </ul>

            </div>
        </div>

        <div class="tab-pane fade" id="v-pills-transactions" role="tabpanel"
             aria-labelledby="v-pills-transactions-tab">
            <div class="card-title">مالی</div>
            <div class="card-body">

                6
            </div>
        </div>

        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
             aria-labelledby="v-pills-profile-tab">
            <div class="card-title">پروفایل</div>
            <div class="card-body">

                2
            </div>
        </div>
    </div>

@endsection

