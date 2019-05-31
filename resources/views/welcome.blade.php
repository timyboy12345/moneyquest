@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="{{route('home')}}" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block wide">
            <h3>{{__('messages.welcome')}}</h3>
            <p>{{__('messages.introduction')}}</p>
        </div>

        <div class="buttons">
            <a class="light large" href="{{route('login')}}">{{__('messages.buttons.login')}}</a>
            <a class="light large" href="{{route('register')}}">{{__('messages.buttons.register')}}</a>
        </div>
    </div>
@endsection