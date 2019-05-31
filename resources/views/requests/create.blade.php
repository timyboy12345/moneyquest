@extends('layout.master')

@section('title', "MoneyQ - Nieuw betaalverzoek")

@section('content')
    <a href="{{route('home')}}" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">
            @if ($bankaccounts->count() > 0)
                <h3 class="text-center">{{__('messages.buttons.newrequest')}}</h3>
                <form method="post">
                    @csrf

                    <div class="formline">
                        <label for="quantity">{{__('messages.words.amount')}}</label>
                        <input autofocus value="{{old('quantity')}}" type="number" name="quantity" id="quantity">

                        @if ($errors->has('quantity'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="formline">
                        <label for=description>{{__('messages.words.description')}}</label>
                        <input value="{{old('description')}}" type="text" name="description" id="description">

                        @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="formline">
                        <label for=description>{{__('messages.words.account')}}</label>
                        <select name="bankaccount" id="bankaccount">
                            @foreach ($bankaccounts as $account)
                                <option value="{{$account->iban}}">{{$account->iban}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('bankaccount'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bankaccount') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="buttons stretch margin-top">
                        <a class="button small" href="{{route('main')}}">{{__('messages.buttons.cancel')}}</a>
                        <input type="submit" style="margin: 5px; width: initial;" class="button small"
                               value="{{__('messages.buttons.createrequest')}}" href="">
                    </div>
                </form>
            @else
                <p>
                    {{__("messages.sentences.bankaccountrequired")}}
                </p>
                <div class="buttons">
                    <a href="{{route('dashboard')}}">{{__("messages.buttons.cancel")}}</a>
                    <a class="button" href="{{route('bankaccounts')}}">{{__("messages.dashboard.manageaccounts")}}</a>
                </div>
            @endif
        </div>
    </div>
@endsection