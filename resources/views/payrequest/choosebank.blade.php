@extends('layout.master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="{{route('home')}}" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">
            <h3 class="text-center">{{__('messages.words.request')}}</h3>
            <h1>Kies je bank</h1>

            <div class="blocks">
                @foreach ($methods->issuers as $method)
                    <a href="{{route('pay_createrequest', [$request->id, $method->id])}}" class="item">
                        <img class="bank" src="{{$method->image->svg}}">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection