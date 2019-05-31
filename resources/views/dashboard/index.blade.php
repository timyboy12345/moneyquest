@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="/" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="column column-50">
            <div class="block">
                <h3>Betaalverzoeken</h3>
                <div class="list wide">
                    @foreach ($requests as $request)
                        <a href="{{route('request', ["id"=>$request->id])}}" class="item">
                            <div class="primary text-purple text-bold">{{$request->description}} - &euro;{{$request->amount}}</div>
                            <div class="secondary">{{$request->bank_iban}}</div>
                        </a>
                    @endforeach
                </div>
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