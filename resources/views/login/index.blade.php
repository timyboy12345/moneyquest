@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('content')
    @if (Route::has('login'))
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login', Config::get('app.locale')) }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        </div>
    @endif

    <a href="/" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">
            <h3 class="text-center">{{__('messages.login')}}</h3>
            <form>
                <div class="formline">
                    <label for="email">Email</label>
                    <input type="email" placeholder="Email" id="email">
                </div>
                <div class="formline">
                    <label for="email">Wachtwoord</label>
                    <input type="password" placeholder="Wachtwoord" id="password">
                </div>
                <input class="button" type="submit">
            </form>
        </div>
    </div>
@endsection