@extends('layout.master')

@section('title', "MoneyQ - Nieuw betaalverzoek")

@section('content')
    <a href="/" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">
            <h3 class="text-center">{{__('messages.buttons.newrequest')}}</h3>
            <div class="request">

                {{__('messages.words.amount')}}<input type="number" name="quantity" id="quantity">
                <label for=email>{{__('messages.words.description')}}</label>
                <input type="text" id="description">

                <div class="articlebuttons">
                    <a class="button small" href="{{route('main')}}">{{__('messages.buttons.cancel')}}</a>
                    <a class="button small" href="">{{__('messages.buttons.createrequest')}}</a>
                </div>
            </div>

        </div>
    </div>
@endsection