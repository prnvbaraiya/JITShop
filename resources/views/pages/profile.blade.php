@extends('layouts.app')
@section('content')
    <div class="profile_container">
        <div class="tab">
            <button class="tablinks active"><a href="/profile">Profile</a></button>
            <button class="tablinks"><a href="wallet">Wallet</a></button>
            <button class="tablinks"><a href="/orderHistory">Order History</a></button>
        </div>
    </div>
    <div class="container">
        <div class="col-md-12 login">
            <form action="/profile/{{ $user->id }}" method="post">
                @csrf
                @method('PATCH')
                <div class="row" style="margin-top:50px;margin-left: 10px;">
                    <div class="col-md-4">
                        <label style="margin-bottom:0px;vertical-align: baseline;margin-top:15px">Name</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{{ $user->name }}" name="name" placeholder="Enter Your Name"
                            class="form-control" />
                    </div>
                </div>
                <div class="row" style="margin-left: 10px;">
                    <div class="col-md-4">
                        <label style="margin-bottom:0px;vertical-align: baseline;margin-top:15px">E-mail</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{{ $user->email }}" name="email" placeholder="Enter Your E-mail"
                            class="form-control" />
                    </div>
                </div>
                <div class="row" style="margin-left: 10px;">
                    <div class="col-md-4">
                        <label style="margin-bottom:0px;vertical-align: baseline;margin-top:15px">Mobile</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{{ $user->mobile }}" name="mobile" placeholder="Enter Your Mobile"
                            class="form-control" />
                    </div>
                </div>
                <div class="row" style="margin-left: 10px;">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8" style="margin-top: 20px">
                        <input type="submit" name="submit" value="Save Changes" class="btn btn-primary" />
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
