@extends('layout.master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="/" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">
            <h3 class="text-center">{{__('messages.buttons.register')}}</h3>
            <form method="post">
                @csrf

                <div class="formline">
                    <label for=username>{{__('messages.register.username')}}</label>
                    <input value="{{old('username')}}" type="text" placeholder="{{__('messages.register.username')}}" id="username" name="username">
                    <div class="hint">{{__('messages.register.username-hint')}}</div>

                    @if ($errors->has('username'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="formline">
                    <label for="email">{{__('messages.words.email')}}</label>
                    <input value="{{old('email')}}" type="text" placeholder="{{__('messages.register.email')}}" id="email" name="email">
                    <div class="hint">{{__('messages.register.email-hint')}}</div>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="formline">
                    <label for="password">{{__('messages.register.password')}}</label>
                    <input type="text" placeholder="{{__('messages.register.password')}}" id="password" name="password">
                    <div class="hint">{{__('messages.register.password-hint')}}</div>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="formline">
                    <label for="password_confirmation">{{__('messages.register.repeat-password')}}</label>
                    <input type="text" placeholder="{{__('messages.register.password')}}" id="password_confirmation"
                           name="password_confirmation">

                    @if ($errors->has('password_confirmation'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="formline">
                    <label for="firstname">{{__('messages.register.first-name')}}</label>
                    <input value="{{old('firstname')}}" type="text" placeholder="{{__('messages.register.first-name')}}" id="firstname"
                           name="firstname">
                    <div class="hint">{{__('messages.register.first-name-hint')}}</div>

                    @if ($errors->has('firstname'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="formline">
                    <label for="middlename">{{__('messages.register.middle-name')}}</label>
                    <input value="{{old('middlename')}}" type="text" placeholder="{{__('messages.register.middle-name')}}" id="middlename"
                           name="middlename">

                    @if ($errors->has('middlename'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('middlename') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="formline">
                    <label for="familyname">{{__('messages.register.last-name')}}</label>
                    <input value="{{old('familyname')}}" type="text" placeholder="{{__('messages.register.last-name')}}" id="familyname"
                           name="familyname">

                    @if ($errors->has('familyname'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('familyname') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="formline">
                    <label for="birthdate">{{__('messages.register.birth-date')}}</label>
                    <input value="{{old('birthdate')}}" type="date" placeholder="{{__('messages.register.birth-date')}}" id="birthdate"
                           name="birthdate">

                    @if ($errors->has('birthdate'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('birthdate') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="formline">
                    <label for="phonenumber">{{__('messages.register.phone-number')}}</label>
                    <input value="{{old('phonenumber')}}" type="text" placeholder="{{__('messages.register.phone-number')}}" id="phonenumber"
                           name="phonenumber">
                    <div class="hint">{{__('messages.register.phone-number-hint')}}</div>

                    @if ($errors->has('phonenumber'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phonenumber') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="formline">
                    <div class="hint">
                        <input name="requirements" id="requirements" type="checkbox">
                        <label for="requirements">{{__('messages.register.conditions')}}</label>
                    </div>
                </div>
                <input class="button" type="submit">
            </form>
        </div>
    </div>
@endsection