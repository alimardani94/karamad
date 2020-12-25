<div class="card">
    <div class="card-body">
        <div class="card-title">دوره های من</div>
        <div class="row row-cols-1 row-cols-md-4">
            @foreach($courses as $course)
                <div class="col my-3">
                    @include('pages.front.layout.single_course', ['course' => $course, 'summarize'=> true])
                </div>
            @endforeach
        </div>
    </div>
</div>
