@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="/" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">
            <h3 class="text-center">{{__('messages.words.welcome')}} {{Auth()->user()->username}}</h3>
            <form>
                <div class="formline">
                    <label for="username">{{__('messages.register.username')}}</label>
                    <input disabled type="text" value="{{Auth()->user()->username}}">
                </div>

                <div class="formline">
                    <label for="email">{{__('messages.register.email')}}</label>
                    <input disabled type="text" value="{{Auth()->user()->email}}">
                </div>

                <div class="formline">
                    <label for="birthdate">{{__('messages.register.birth-date')}}</label>
                    <input disabled type="text" value="{{Auth()->user()->birthdate}}">
                </div>

                <div class="formline">
                    <label for="firstname">{{__('messages.register.first-name')}}</label>
                    <input disabled type="text" value="{{Auth()->user()->firstname}}">
                </div>

                <div class="formline">
                    <label for="middlename">{{__('messages.register.middle-name')}}</label>
                    <input disabled type="text" value="{{Auth()->user()->middlename}}">
                </div>

                <div class="formline">
                    <label for="familyname">{{__('messages.register.last-name')}}</label>
                    <input disabled type="text" value="{{Auth()->user()->familyname}}">
                </div>
            </form>
        </div>

        <div class="block">
            <div class="buttons">
                <a href="../">Home</a>
                <a href="../">Account verwijderen</a>
            </div>
        </div>
    </div>
@endsection