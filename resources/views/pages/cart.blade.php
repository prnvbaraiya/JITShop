@extends('layouts.app')
@section('content')
    <?php
    $items = App\Http\Controllers\CartController::getCart();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php
                    $sum = 0;
                    ?>
                    <tbody>
                        @foreach ($items as $item)
                            <?php
                            $product = App\Http\Controllers\CartController::getProduct($item->product_id);
                            $sum += $item->quantity * $product->price;
                            ?>
                            <tr>
                                <td class="col-sm-8 col-md-6">
                                    <div class="media">
                                        <a class="thumbnail pull-left" href="#"> <img class="media-object"
                                                src="{{ $product->image }}" style="width: 72px; height: 72px;"> </a>
                                        <div class="media-body">
                                            <h4 class="media-heading"><a href="#">{{ $product->name }}</a></h4>
                                        </div>
                                    </div>
                                </td>
                                <td class="col-sm-1 col-md-1" style="text-align: center">
                                    <strong>{{ $item->quantity }}</strong>
                                </td>
                                <td class="col-sm-1 col-md-1 text-center"><strong>Rs.{{ $product->price }}</strong></td>
                                <td class="col-sm-1 col-md-1 text-center">
                                    <strong>Rs.{{ $item->quantity * $product->price }}</strong>
                                </td>
                                <td class="col-sm-1 col-md-1">
                                    <a href="/cart/remove/{{ $item->id }}">
                                        <button type="button" class="btn btn-danger">
                                            <span class="glyphicon glyphicon-remove"></span> Remove
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <h3>Total</h3>
                            </td>
                            <td class="text-right">
                                <h3><strong>Rs.{{ $sum }}</strong></h3>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="/">
                                    <button type="button" class="btn btn-default">
                                        <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                                    </button>
                                </a>
                            </td>
                            <td>
                                <a href="/checkoutAddress">
                                    <button type="button" class="btn btn-success">
                                        Checkout <span class="glyphicon glyphicon-play"></span>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
