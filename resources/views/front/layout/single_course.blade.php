<div class="card h-100 m-1">
    <div class="view overlay">
        <img src="{{ asset('media/' .$course->thumbnail) }}" class="card-img-top"
             alt="{{ $course->title }}" style="max-height: 120px">
        <a href="{{  route('courses.show', ['course' => $course->id, 'slug' => $course->slug]) }}">
            <div class="mask rgba-white-slight waves-effect waves-light"></div>
        </a>
    </div>
    <div class="card-body">
        <a href="" class="teal-text text-center text-uppercase font-small"></a>
        <h5 class="card-title">
            <a href="{{  route('courses.show', ['course' => $course->id, 'slug' => $course->slug]) }}">
                <strong class="black-text">{{$course->title}}</strong>
            </a>
        </h5>
        @if(!isset($summarize))
            <hr>
            <p class="dark-grey-text mb-4 course-summary">
                {{ $course->summary }}
            </p>
        @endif
        <p class="text-left mb-0 font-small">
            <a class="btn btn-default btn-sm" style="position: absolute; bottom: 5px; left: 5px"
               href="{{  route('courses.show', ['course' => $course->id, 'slug' => $course->slug]) }}">
                مشاهده
            </a>
        </p>
    </div>
</div>
