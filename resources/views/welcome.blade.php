@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="/" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block wide">
            <h3>Welkom bij MoneyQ</h3>
            <p>Dit is MoneyQ, hét betaalplatform van Nederland</p>
        </div>

        <div class="buttons">
            <a class="light large" href="{{route('login')}}">Inloggen</a>
        </div>
    </div>
@endsection