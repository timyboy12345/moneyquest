@extends('layout.master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="{{route('home')}}" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">
            <h3 class="text-center">{{__('messages.buttons.login')}}</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="formline">
                    <label for="email">{{__('messages.words.email')}}</label>
                    <input required type="email" placeholder="{{__('messages.words.email')}}" name="email" id="email">
                    @if ($errors->has('email'))
                        <span class="alert red">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>
                <div class="formline">
                    <label for="email">{{__('messages.words.password')}}</label>
                    <input required type="password" placeholder="{{__('messages.words.password')}}" name="password"
                           id="password">
                    @if ($errors->has('password'))
                        <span class="alert red">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>
                <input class="button" type="submit">
            </form>
        </div>
    </div>
@endsection