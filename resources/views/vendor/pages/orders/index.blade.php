@extends('layouts.vendor')
@section('content')
    @component('admin.components.table', ['columns' => $columns, 'contents' => (array) $orders, 'tableName' => 'orders'])
    @endcomponent
@endsection
