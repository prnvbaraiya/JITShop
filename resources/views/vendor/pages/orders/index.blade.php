@extends('layouts.vendor')
@section('content')
    @component('vendor.components.table', ['columns' => $columns, 'contents' => (array) $orders, 'tableName' => 'orders'])
    @endcomponent
@endsection
