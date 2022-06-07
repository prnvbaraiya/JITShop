@extends('layouts.app')
@section('content')
@include('partial.slider')
<hr/>
<div class="contact-section margin-top">
    <h1>Contact US</h1><br/> 
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div>
                    <h3>Address</h3>
                    <label>Address Line 1, </label>
                    <label>Address Line 2, </label><br/>
                    <label>Address Line 3, </label>
                    <label>City - 123 456, </label><br/>
                    <label> State ,</label> <label> Country</label><br/>

                    <label><span class="glyphicon glyphicon-phone"></span> +91 - 98765 43210</label><br/>
                    <label><span class="glyphicon glyphicon-envelope"></span> mail@abcmail.com</label>
                </div><br/>
                <div> 
                    <h3>Follow us on</h3><br/>
                    <a href="#" class="float-shadow">
                        <img src="image/fb.png"/>
                    </a>
                    <a href="#" class="float-shadow">
                        <img src="image/twit.png"/>
                    </a>
                    <a href="#" class="float-shadow">
                        <img src="image/gp.png"/>
                    </a>
                    <a href="#" class="float-shadow">
                        <img src="image/yt.png"/>
                    </a>
                </div>
            </div>
            <div class="col-md-6" align="center">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3686.9102713053376!2d70.04714331520314!3d22.470005942390763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3957154d477d7813%3A0xcd3e8e16f3cd939e!2sBinary%20Developers!5e0!3m2!1sen!2sin!4v1593174125871!5m2!1sen!2sin" width="100%" height="500" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection