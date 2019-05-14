@extends('layout/master')

@section('title', "MoneyQ - Nieuw betaalverzoek")

@section('content')
    <a href="/" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">
            <h3 class="text-center">{{__('messages.buttons.newrequest')}}</h3>
            <form method="post">
                @csrf

                <div class="formline">
                    <label for="quantity">{{__('messages.words.amount')}}</label>
                    <input type="number" name="quantity" id="quantity">
                </div>

                <div class="formline">
                    <label for=description>{{__('messages.words.description')}}</label>
                    <input type="text" id="description">
                </div>

                <div class="buttons stretch margin-top">
                    <a class="button small" href="{{route('main')}}">{{__('messages.buttons.cancel')}}</a>
                    <input type="submit" style="margin: 5px; width: initial;" class="button small" value="{{__('messages.buttons.createrequest')}}" href="">
                </div>
            </form>
        </div>
    </div>
@endsection