@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="/" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">
            <h3 class="text-center">{{__('messages.buttons.login')}}</h3>
            <form>
                <div class="formline">
                    <label for="email">{{__('messages.words.email')}}</label>
                    <input type="email" placeholder="{{__('messages.words.email')}}" id="email">
                </div>
                <div class="formline">
                    <label for="email">{{__('messages.words.password')}}</label>
                    <input type="password" placeholder="{{__('messages.words.password')}}" id="password">
                </div>
                <input class="button" type="submit">
            </form>
        </div>
    </div>
@endsection