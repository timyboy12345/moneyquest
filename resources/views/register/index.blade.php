@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="/" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">
            <h3 class="text-center">{{__('messages.buttons.login')}}</h3>
            <form>
                <div class="formline">
                    <label for=email>{{__('messages.register.username')}}</label>
                    <input type="text" placeholder="{{__('messages.register.username')}}" id="username">
                    <div class="hint">{{__('messages.register.username-hint')}}</div>
                </div>
                <div class="formline">
                    <label for="email">{{__('messages.words.password')}}</label>
                    <input type="text" placeholder="{{__('messages.words.password')}}" id="password">
                </div>
                <input class="button" type="submit">
            </form>
        </div>
    </div>
@endsection