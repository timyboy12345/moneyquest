@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="{{route('home')}}" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">
            <h3 class="text-center">{{__('messages.words.request')}}</h3>
            <div class="articleflex">
                <div class="article">
                    <div class="blockborder">
                        <h1>{{$request->user->username}} {{__('messages.pay.is-asking')}} {{$request->amount}} {{__('messages.pay.for')}} {{$request->description}}</h1>
                        <div class="buttons">
                            <a class="button large"
                               href="{{route('pay_choosebank', $request->id)}}">{{__('messages.buttons.ok')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection