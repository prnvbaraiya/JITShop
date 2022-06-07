@extends('layouts.app')
@section('content')
<div class="category margin-top container slide">
    {{$product->id}}<br>
    {{$product->name}}<br>
    {{$product->attributes}}
</div>
    
@endsection