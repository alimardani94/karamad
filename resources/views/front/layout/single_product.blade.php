<div class="card card-ecommerce h-100 m-1">
    <div class="view overlay" style="max-height: 220px">
        <img src="{{ $product->image() }}"
             class="img-fluid" alt="{{ $product->name }}">
        <a href="{{ route('shop.product', ['id' => $product->id, 'slug' => $product->slug]) }}">
            <div class="mask rgba-white-slight waves-effect waves-light"></div>
        </a>
    </div>

    <div class="card-body">
        <h5 class="card-title mb-1">
            <strong><a href="{{ route('shop.product', ['id' => $product->id, 'slug' => $product->slug]) }}"
                       class="dark-grey-text">{{ $product->name }}</a></strong>
        </h5>

        @foreach($product->tags as $tag)
            <span class="badge badge-primary mb-2">{{$tag->name}}</span>
        @endforeach

{{--        <ul class="rating">--}}
{{--            <li><i class="fas fa-star blue-text"></i></li>--}}
{{--            <li><i class="fas fa-star blue-text"></i></li>--}}
{{--            <li><i class="fas fa-star blue-text"></i></li>--}}
{{--            <li><i class="fas fa-star blue-text"></i></li>--}}
{{--            <li><i class="fas fa-star blue-text"></i></li>--}}
{{--        </ul>--}}

        <div class="card-footer pb-0">
            <div class="mb-0">
                <div class="float-right">
                    <strong>{{ number_format($product->price) }}</strong> تومان
                </div>

                <div class="float-left">
                    <a href="{{ route('shop.cart.add', ['product' => $product->id, 'count'=> '1']) }}"
                       data-toggle="tooltip" data-placement="top" title=""
                       data-original-title="Add to Cart">
                        <i class="fas fa-shopping-cart mr-3"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
