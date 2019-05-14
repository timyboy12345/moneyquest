@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="/" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="column column-50">
            <div class="block">
                <h3>{{__('messages.welcome')}}</h3>
                <ul>
                    <li>{{Auth::user()->username}}</li>
                    <li>{{Auth::user()->email}}</li>
                </ul>
            </div>
        </div>

        <div class="column column-50">
            <div class="block">
                <h3>{{__("messages.dashboard.youraccounts")}}</h3>
                <ul>
                    @foreach($bank_accounts as $account)
                        <li>{{$account->iban}}</li>
                    @endforeach
                </ul>
                <div class="buttons small">
                    <a href="{{route('bankaccounts')}}"
                       class="button small">{{__("messages.dashboard.manageaccounts")}}</a>
                </div>
            </div>

            <div class="buttons stretch">
                <a class="light large" href="{{route('requests')}}">{{__('messages.buttons.allrequests')}}</a>
                <a class="light large" href="{{route('createrequest')}}">{{__('messages.buttons.newrequest')}}</a>
                <a class="light large" href="{{route('account')}}">{{__('messages.buttons.account')}}</a>
                <a class="light large" href="{{route('logout')}}">{{__('messages.buttons.logout')}}</a>
                <a class="light large" href="{{route('pay')}}">{{__('pay')}}</a>
            </div>
        </div>
    </div>
@endsection