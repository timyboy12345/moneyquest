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
                        <h1>{{$request->user->username}} {{__('messages.pay.is-asking')}} {{$request->amount}} {{$request->currency}} {{__('messages.pay.for')}} {{$request->description}}</h1>
                        <h3>{{__('messages.pay.date')}}{{$request->updated_at}}</h3>
                        <img class="image" src="{{Storage::url($request->image)}}"/>
                        <p>{{$request->comment}}</p>
                        <div class="buttons">
                            <a class="button large"
                               href="{{route('pay_choosebank', $request->id)}}">{{__('messages.buttons.ok')}}</a>
                        </div>
                    </div>
        <div class="column">
            <div class="block">
                <div class="buttons">
                    <a class="button" href="{{route('schedule', $request->id)}}">{{__('messages.buttons.schedule')}}</a>
                    <a class="button" href="{{route('pay_choosebank', $request->id)}}">{{__('messages.buttons.paynow')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection