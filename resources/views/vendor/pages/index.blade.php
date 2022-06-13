@extends('layouts.vendor');

@section('content')
    <h1>Hello {{ Session::get('vendorName') }}</h1>
@endsection
