@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="{{route('home')}}" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block wide">
            <h3>{{__("messages.dashboard.youraccounts")}}</h3>
            <ul>
                @foreach($bank_accounts as $account)
                    <li>{{$account->iban}} <a href="{{route('bankaccounts-delete', $account->iban)}}">{{__('messages.buttons.delete')}}</a></li>
                @endforeach
            </ul>

            <form method="post">
                @csrf

                <div class="formline">
                    <label for="account">{{__('messages.words.bankaccount')}}</label>
                    <input required name="account" placeholder="{{__('messages.words.bankaccount')}}" type="text">

                    @if ($errors->has('account'))
                        <div class="alert red">
                            {{ $errors->first('account') }}
                        </div>
                    @endif
                </div>

                <input type="submit">
            </form>
        </div>
    </div>
@endsection