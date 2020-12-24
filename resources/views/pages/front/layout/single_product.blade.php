<div class="card card-ecommerce h-100 m-1">
    <div class="view overlay" style="max-height: 220px">
        <img src="{{ $product->image() }}"
             class="card-img-top" alt="{{ $product->name }}">
        <a href="{{ route('shop.product', ['id' => $product->id, 'slug' => $product->slug]) }}">
            <div class="mask rgba-white-slight waves-effect waves-light"></div>
        </a>
    </div>

    <div class="card-body">
        <h5 class="card-title mb-1">
            <strong>
                <a href="{{ route('shop.product', ['id' => $product->id, 'slug' => $product->slug]) }}"
                   class="dark-grey-text">
                    {{ $product->name }}
                </a>
            </strong>
        </h5>

        <div>
            <a href="{{ route('schools.show', ['school' => $product->owner->school->id]) }}"
               class="my-3">
                نام مدرسه:
                {{ $product->owner->school->name }}
            </a>
        </div>

        @foreach($product->tags as $tag)
            <small><span class="badge badge-primary badger mb-2">{{ $tag->name }}</span></small>
        @endforeach

        {{--        <ul class="rating">--}}
        {{--            <li><i class="fas fa-star blue-text"></i></li>--}}
        {{--            <li><i class="fas fa-star blue-text"></i></li>--}}
        {{--            <li><i class="fas fa-star blue-text"></i></li>--}}
        {{--            <li><i class="fas fa-star blue-text"></i></li>--}}
        {{--            <li><i class="fas fa-star blue-text"></i></li>--}}
        {{--        </ul>--}}

        <div class="card-footer px-0 pb-0 d-flex justify-content-around">
            <div class="">
                @if($product->discount)
                    <span class="grey-text">
                        <small>
                            <s>{{ number_format(round($product->price, -2)) }}</s>
                        </small>
                    </span>
                @endif
                <strong>{{ number_format($product->final_price) }}</strong>
                تومان
            </div>

            <div class="">
                <a href="{{ route('shop.cart.add', ['product' => $product->id, 'count'=> '1']) }}"
                   data-toggle="tooltip" data-placement="top" title=""
                   data-original-title="Add to Cart">
                    <i class="fad fa-shopping-basket mr-3"></i>
                </a>
            </div>
        </div>
    </div>
</div>
