@extends('layout/master')

@section('content')
    <div style="background: #1d68a7" class="wrapper">
        <div class="block wide">
            <h3>{{__('messages.welcome')}}</h3>
            <p>{{__($user->username)}}</p>
            <h3>Dit is een test mail lmao!</h3>
            <p>
            </p>
        </div>
    </div>
@endsection