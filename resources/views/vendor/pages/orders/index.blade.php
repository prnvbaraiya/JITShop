@extends('layouts.vendor')
@section('content')
    @component('vendor.components.table', ['columns' => $columns, 'contents' => $orders, 'tableName' => 'orders'])
    @endcomponent
@endsection
