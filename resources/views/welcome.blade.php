@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="/" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block wide">
            <h3>{{__('messages.welcome')}}</h3>
            <p>{{__('messages.introduction')}}</p>
        </div>

        <div class="buttons">
            <a class="light large" href="{{route('login', Config::get('app.locale'))}}">Inloggen</a>
        </div>
    </div>
@endsection