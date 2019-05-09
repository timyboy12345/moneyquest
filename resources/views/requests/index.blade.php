@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="/" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">
            <h3 class="text-center">{{__('messages.words.request')}}</h3>
            <form method="post">
                @csrf

                <div class="formline">
                    <label for="quantity">{{__('messages.words.amount')}}</label>
                    <input disabled value="{{$request->amount}}" type="number" name="quantity" id="quantity">
                </div>

                <div class="formline">
                    <label for=description>{{__('messages.words.description')}}</label>
                    <input disabled value="{{$request->description}}" type="text" id="description">
                </div>

                <div class="buttons stretch margin-top">
                    <a class="button small" href="{{route('main')}}">{{__('messages.buttons.back')}}</a>
                </div>
            </form>
        </div>
    </div>
@endsection