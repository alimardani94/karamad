<div class="card m-1">
    <div class="view overlay">
        <img src="{{ asset('media/' .$post->image) }}" class="card-img-top"
             alt="{{ $post->title }}">
        <a href="{{ route('posts.show', ['post' => $post->id]) }}">
            <div class="mask rgba-white-slight waves-effect waves-light"></div>
        </a>
    </div>
    <div class="card-body">
        <a href="" class="teal-text text-center text-uppercase font-small"></a>
        <h5 class="card-title">
            <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                <strong class="black-text">{{$post->title}}</strong>
            </a>
        </h5>
        <hr>
        <div class="font-small blue-grey-text mb-0 text-right">
            <i class="fal fa-clock"></i> {{ jDate($post->created_at, 'dd MMMM yyyy') }}
        </div>
        <p class="text-left mb-0 font-small">
            <a class="btn btn-default btn-sm"
               href="{{ route('posts.show', ['post' => $post->id]) }}">
                مشاهده
            </a>
        </p>
    </div>
</div>
