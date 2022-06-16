@extends('layouts.app')
@section('content')
    <x-banner />
    @include('partial.slider')
    <x-sbc :categories="$categories" />
    <x-sbs :sellers="$sellers" />

    <div>
        <div class="left-side-info">
            <div align="center">
                <h1>Hello, World From <span class="color">IT Jamnagar</span></h1>
                <label>Jamnagar Information Technology Association</label>
                <p>Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is
                    here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text
                    is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some
                    Text is here Some Text is here Some Text is here Some Text is here Some Text is here Some Text is here
                    Some Text is here Some Text is here Some Text is here Some Text is here </p>
            </div>

        </div>
    </div>

    <div class="form__container form__register">
        <form action="/login" method="post" class="form">
            @csrf
            <h1 class="form__heading">Register<button onclick="closeForm(event,'register')" class="form__close">X</button></h1>
            <div class="form__content">
                <div class="checkbox__container">
                    <label for="loginType" class="checkbox__label">User</label>
                    <input type="checkbox" name="loginType" class="form__checkbox">
                    <label for="loginType" class="checkbox__label">Vendor</label>
                </div>
                <div class="input__container">
                    <input type="text" name="email" class="input" placeholder="a">
                    <label for="email" class="label">Email</label>
                </div>
                <div class="input__container">
                    <input type="text" name="email" class="input" placeholder="a">
                    <label for="mobile" class="label">Mobile</label>
                </div>
                <div class="input__container">
                    <input type="password" name="password" class="input" placeholder="a">
                    <label for="password" class="label">Password</label>
                </div>
                <div class="input__container">
                    <input type="password" name="password_confirmation" class="input" placeholder="a">
                    <label for="password" class="label">Confirm Password</label>
                </div>
                <input type="submit" class="submit__button" value="Login">
        </form>
    </div>


    <div class="form__container form__login">
        <form action="/login" method="post" class="form">
            @csrf
            <h1 class="form__heading">Login<button onclick="closeForm(event,'login')" class="form__close">X</button></h1>
            <div class="form__content">
                <div class="input__container">
                    <input type="text" name="email" class="input" placeholder="a">
                    <label for="email" class="label">Email</label>
                </div>

                <div class="input__container">
                    <input type="password" name="password" class="input" placeholder="a">
                    <label for="password" class="label">Password</label>
                </div>

                <input type="submit" class="submit__button" value="Login">
        </form>
    </div>

    <script>
        var flogin = document.querySelector('.form__login');
        var fregister = document.querySelector('.form__register');
        var fopen = 0;

        function openForm(event, form) {
            event.preventDefault();
            if (fopen == 0) {
                if (form == "login") {
                    fcontainer = flogin;
                } else {
                    fcontainer = fregister;
                }
                fcontainer.classList.remove('form__hide');
                fcontainer.classList.add('form__show');
                fopen = 1;
            }
        }

        function closeForm(event, form) {
            if (fopen == 1) {
                event.preventDefault();
                if (form == "login") {
                    fcontainer = flogin;
                } else {
                    fcontainer = fregister;
                }
                fcontainer.classList.remove('form__show');
                fcontainer.classList.add('form__hide');
                fopen = 0;
            }
        }
    </script>
@endsection
