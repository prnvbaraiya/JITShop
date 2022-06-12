@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <address>
                            <strong>{{ $user->name }}</strong>
                            <br>
                            {{ $address }}
                            <br>
                            <abbr title="Phone">P:</abbr> {{ $user->mobile }}
                        </address>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                        <p>
                            <em>Date: {{ substr($order->time, 0, 11) }}</em>
                        </p>
                        <p>
                            <em>Receipt #: {{ $order->id }}</em>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="text-center">
                        <h1>Receipt</h1>
                    </div>
                    </span>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th class="text-center">#</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Total(Rs.)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count($data); $i++)
                                <tr>
                                    <td class="col-md-9"><em>{{ $data[$i]['name'] }}</em></h4>
                                    </td>
                                    <td class="col-md-1" style="text-align: center"> {{ $data[$i]['quantity'] }}
                                    </td>
                                    <td class="col-md-1 text-center">{{ $data[$i]['price'] }}</td>
                                    <td class="col-md-1 text-center">{{ $data[$i]['total'] }}</td>
                                </tr>
                            @endfor
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td class="text-right">
                                    <h4><strong>Total: </strong></h4>
                                </td>
                                <td class="text-center text-danger">
                                    <h4><strong>{{ $order->total }}</strong></h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="/"><button type="button" class="btn btn-success btn-lg btn-block">
                            Continue Shopping<span class="glyphicon glyphicon-chevron-right"></span>
                        </button></a></td>
                </div>
            </div>
        </div>
    </div>
@endsection
