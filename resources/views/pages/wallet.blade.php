@extends('layouts.app')
@section('content')
    <div class="profile_container">
        <div class="tab">
            <button class="tablinks"><a href="/profile">Profile</a></button>
            <button class="tablinks active"><a href="wallet">Wallet</a></button>
            <button class="tablinks"><a href="/orderHistory">Order History</a></button>
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
