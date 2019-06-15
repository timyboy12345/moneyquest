@extends('layout.master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="{{route('home')}}" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">

            <h3 class="text-center">{{__('messages.words.request')}}</h3>
            <h1>{{__('messages.sentences.choose-provider')}}</h1>

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