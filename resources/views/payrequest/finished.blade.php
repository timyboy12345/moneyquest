@extends('layout.master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="{{route('home')}}" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">
            <h3 class="text-center">{{__('messages.words.request')}}</h3>

            @if ($mollie_payment->status == 'paid')
                <p>{{__('messages.pay.success')}}</p>
            @else
                <p>{{__('messages.pay.error')}}</p>
            @endif
        </div>
    </div>
@endsection