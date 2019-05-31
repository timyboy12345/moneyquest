@extends('layout.master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="{{route('home')}}" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">
            <h3 class="text-center">{{__('messages.words.request')}}</h3>
            <p>{{__('messages.yay')}}</p>
        </div>
    </div>
@endsection