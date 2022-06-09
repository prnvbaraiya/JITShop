@extends('layouts.app')
@section('content')
<div class="product__container">
    <div class="product__image">
        <img src="{{$product->image}}" alt="Product Image">
    </div>
    <div class="product__details">
        <label class="product__name">{{$product->name}}</label>
        <label class="product__quantity">
            @if($product->quantity==0)
                Currently Unavailable
            @elseif($product->quantity<3)
                Only {{$product->quantity}} left
            @endif
        </label>
        <label>{{$product->details}}</label>
        <label>Rs.{{$product->price}}</label>
        <div class="row">
        <button class="btnn" >Add to cart</button>
        <button class="btnn" >Buy Now</button>
        </div>
    </div>
</>
    
@endsection