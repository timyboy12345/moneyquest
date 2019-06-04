@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="{{route('home')}}" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="column">
            <div class="block">
                <h3 class="text-center">{{__('messages.words.request')}}</h3>
                <h4 class="text-center">{{ucfirst($request->user->username)}} {{__('messages.pay.is-asking')}} {{$request->amount}} {{__('messages.pay.for')}} {{$request->description}}</h4>
                <div class="buttons">
                    <a class="button" href="{{route('schedule', $request->id)}}">{{__('messages.buttons.schedule')}}</a>
                    <a class="button" href="{{route('pay_choosebank', $request->id)}}">{{__('messages.buttons.paynow')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection