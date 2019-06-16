@extends('layout.master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="{{route('home')}}" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">

            <h3 class="text-center">{{__('messages.words.request')}}</h3>
            <h1>{{__('messages.sentences.choose-method')}}</h1>

            <form method="get">
                <div class="blocks">
                    @foreach ($currencies as $currency)
                        <button type="submit" name="currency" value="{{$currency['iso']}}" class="item">{{$currency['name']}}</button>
                    @endforeach
                </div>
            </form>

            <form method="post">
                @csrf

                <div class="blocks">
                    @foreach ($providers as $provider)
                        <button type="submit" name="provider" value="{{$provider->id}}" class="item">
                            <img class="bank" src="{{$provider->image->svg}}">
                        </button>
                    @endforeach
                </div>
            </form>
        </div>
    </div>
@endsection