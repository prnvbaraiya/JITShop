@extends('layouts.app')
@section('content')
    <div>
	
<div class="login-section">
    <div class="container" style="margin-top:-15rem;">
        <div class="row">    
            @if (session('message'))
            <div style="background-color:lightgreen;background-opacity:1;margin-top:5rem;text-align:center;text-color:black;">{{session('message')}}</div>
            @endif
            @if($errors->any())
            {!! implode('',$errors->all('<div>:message</div>'))!!}
        @endif
            <div class="col-md-5 login">
                <h1>Login</h1>
                <form method="post">
                    @csrf
                    <div>
                        <input type="text" name="email" placeholder="Email" class="form-control"/>
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="Password" class="form-control"/>
                    </div>
                    <div>
                        <input type="submit" value="Login" name="ok" class="btn btn-submit"/>
                    </div>
                    <div class="forgot-pass">
                        <a href="forgot-pass.php">Forgot Password ?</a>
                    </div>
                    <div class="forgot-pass regi-link" align="center">
                        <a href="/login">Don't have an Account Register Here</a>
                    </div>
                </form>
            </div>
            <div class="col-md-1 border-seprator" align="center">
                <img src="image/line.png"/>
            </div>
            <div class="col-md-6 register">
                <h1>Register</h1>
                <form action="/register" method="post">
                    @csrf
                    <div>
                        <input type="text" name="name" placeholder="Enter Name" class="form-control"/>
                    </div>
                    <div>
                        <input type="text" name="email" placeholder="Email" class="form-control"/>
                    </div>
                    <div>
                        <input type="text" name="mobile" placeholder="Contact" class="form-control"/>
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="Password" class="form-control"/>
                    </div>
                    <div>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control"/>
                    </div>
                    <div>
                        <input type="submit" value="Register" class="btn btn-submit"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    </div>
@endsection