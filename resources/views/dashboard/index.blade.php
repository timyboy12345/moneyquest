@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="/" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">
            <h3>{{__('messages.welcome')}}</h3>
            <ul>
                <li>{{Auth::user()->name}}</li>
                <li>{{Auth::user()->email}}</li>
            </ul>
        </div>

        <div class="block">
            <ul>
                @foreach($bank_accounts as $account)
                    <li>{{$account->iban}}</li>
                @endforeach
            </ul>
        </div>

        <div class="buttons">
            <a class="light large" href="{{route('logout')}}">{{__('messages.buttons.logout')}}</a>
        </div>
    </div>
@endsection