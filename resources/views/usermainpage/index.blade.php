@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="/" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">
            <h3 class="text-center">{{__('messages.words.welcome')}}</h3>
            <div class="articleflex">
            <div class="article">
                <h3 class="text-center">{{__('messages.requests.myrequests')}}</h3>
            </div>
            <div class="article">
                <h3 class="text-center">{{__('messages.requests.recentpayments')}}</h3>
                <div class="articlebuttons">
                    <a class="button small" href="{{route('request')}}">{{__('messages.buttons.allrequests')}}</a>
                    <a class="button small" href="">{{__('messages.buttons.logout')}}</a>
                    <a class="button small" href="{{route(('newrequest'))}}">{{__('messages.buttons.newrequest')}}</a>
                    <a class="button small" href="{{route('account')}}">{{__('messages.buttons.account')}}</a>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection