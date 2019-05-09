@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="/" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">
            <h3 class="text-center">{{__('messages.buttons.register')}}</h3>
            <form>
                <div class="formline">
                    <label for=email>{{__('messages.register.username')}}</label>
                    <input type="text" placeholder="{{__('messages.register.username')}}" id="username">
                    <div class="hint">{{__('messages.register.username-hint')}}</div>
                </div>
                <div class="formline">
                    <label for="email">{{__('messages.words.email')}}</label>
                    <input type="text" placeholder="{{__('messages.register.email')}}" id="email">
                    <div class="hint">{{__('messages.register.email-hint')}}</div>
                </div>
                <div class="formline">
                    <label for="email">{{__('messages.register.password')}}</label>
                    <input type="text" placeholder="{{__('messages.register.password')}}" id="password">
                    <div class="hint">{{__('messages.register.password-hint')}}</div>
                </div>
                <div class="formline">
                    <label for="email">{{__('messages.register.repeat-password')}}</label>
                    <input type="text" placeholder="{{__('messages.register.password')}}" id="repeatpassword">
                </div>
                <div class="formline">
                    <label for="email">{{__('messages.register.first-name')}}</label>
                    <input type="text" placeholder="{{__('messages.register.first-name')}}" id="firstname">
                    <div class="hint">{{__('messages.register.first-name-hint')}}</div>
                </div>
                <div class="formline">
                    <label for="email">{{__('messages.register.middle-name')}}</label>
                    <input type="text" placeholder="{{__('messages.register.middle-name')}}" id="middlename">
                </div>
                <div class="formline">
                    <label for="email">{{__('messages.register.birth-date')}}</label>
                    <input type="date" placeholder="{{__('messages.register.birth-date')}}" id="birthdate">
                </div>
                <div class="formline">
                    <label for="email">{{__('messages.register.phone-number')}}</label>
                    <input type="text" placeholder="{{__('messages.register.phone-number')}}" id="phonenumber">
                    <div class="hint">{{__('messages.register.phone-number-hint')}}</div>
                </div>
                <div class="formline">
                    <label for="email">{{__('messages.register.account-number')}}</label>
                    <input type="text" placeholder="{{__('messages.register.account-number')}}" id="phonenumber">
                </div>
                <div class="formline">

                    <div class="hint">
                        <input type="checkbox">
                        {{__('messages.register.conditions')}}

                    </div>
                </div>
                <input class="button" type="submit">
            </form>
        </div>
    </div>
@endsection