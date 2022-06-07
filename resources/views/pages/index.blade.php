@extends('layouts.app')
@section('content')
    <x-banner/>
    @include('partial.slider')
    <x-sbc/>
    <x-sbs/>
    
    <div>
        <div class="left-side-info">
            <div align="center">
                <h1>Hello, World From <span class="color">IT Jamnagar</span></h1>
                <label>Jamnagar Information Technology Association</label>
                <p>Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here </p>
            </div>

        </div>   	
    </div>
@endsection