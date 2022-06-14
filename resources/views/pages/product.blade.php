@extends('layouts.app')
@section('content')
    <div class="product__container">
        <div class="product__image">
            <img src="{{ $product->image }}" alt="Product Image">
        </div>
        <div class="product__details">
            <label class="product__name">{{ $product->name }}</label>
            <label class="product__quantity">
                @if ($product->quantity == 0)
                    Currently Unavailable
                @elseif($product->quantity < 3)
                    Only {{ $product->quantity }} left
                @endif
            </label>
            <label>{{ $product->details }}</label>
            <label>Rs.{{ $product->price }}</label>
            <br>
            @if ($product->quantity > 0)
                <form action="/cart" method="post">
                    @csrf
                    <div class="row">
                        <button class="btn" style="margin-left: 15px;" onClick="addItems(event,'add')">+</button>
                        <input type="number" id="items" name="quantity" value="1" style="width: 30px;" readonly="readonly">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button class="btn" onClick="addItems(event,'sub')">-</button>
                    </div>
                    <br>
                    <div class="row">
                        <input type="submit" class="btnn" style="margin-left: 15px;" value="Add to cart">
                        <button class="btnn">Buy Now</button>
                    </div>
                </form>
                <div class="row mt-3">
                    Seller : <label class="text-capitalize"> {{ $product->vendor->name }}</label>
                </div>
                <script>
                    function addItems(event, operation) {
                        event.preventDefault();
                        var count = document.getElementById('items').value;
                        if (operation == "add") {
                            if (count < {{ $product->quantity }})
                                count++;
                        } else {
                            if (count > 1)
                                count--;
                        }
                        document.getElementById('items').value = count;
                    }
                </script>
                <br>
            @endif
        </div>
    </div>
@endsection
