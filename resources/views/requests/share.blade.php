@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="{{route('home')}}" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="column">
            <div class="block">
                <h3 class="text-center">{{__('messages.words.request')}}</h3>
                <p>{{$request->description}}</p>

                <input class="copyinput" type="text" value="{{env('NGROK_ADDRESS')}}/pay/{{$request->id}}" readonly>
            </div>
        </div>
    </div>
@endsection