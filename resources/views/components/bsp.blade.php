<div class="category margin-top">
    <div class="container slide">
        <h1>Best Selling Product</h1><br />
        <div class="row">
            @foreach ($bestSProducts as $product)
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <a href="/category/{{ $product->id }}">
                        <div class="box">
                            <img src="{{ $product->image ?? '/storage/product/no-image.png' }}" /><br />
                            <label>{{ $product->name }}</label><br />
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
