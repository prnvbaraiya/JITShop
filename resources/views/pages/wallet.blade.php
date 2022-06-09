@extends('layouts.app')
@section('content')
    <div class="profile_container">
        <div class="tab">
            <a href="/profile"><button class="tablinks">Profile</button></a>
            <a href="wallet"><button class="tablinks active">Wallet</button></a>
            <a href="/orderHistory"><button class="tablinks">Order History</button></a>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <h3>You Have <span>0</span> Rs left</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
