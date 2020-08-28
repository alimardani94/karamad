<div class="card m-1">
    <!-- Card image -->
    <div class="view overlay">
        <img src="{{ $product->image() }}"
             class="card-img-top" alt="sample image">
        <a href="{{ route('shop.product', ['id' => $product->id]) }}">
            <div class="mask rgba-white-slight"></div>
        </a>
    </div>

    <div class="card-body">
        <h4 class="card-title">
            <a href="{{ route('shop.product', ['id' => $product->id]) }}">
                <strong>{{ $product->name }}</strong>
            </a>
        </h4>
        <hr>

        <p class="font-small font-weight-bold dark-grey-text mb-1">
            <strong>{{ number_format($product->price) }}</strong> تومان
        </p>
        <p class="font-small grey-text mb-0">{{ $product->meta_description }}</p>
    </div>
</div>
