@extends('layout.master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="{{route('home')}}" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">

            <h3 class="text-center">{{__('messages.words.request')}}</h3>
            <p>[VERTAAL MIJ!] Je gaat betalen in {{$provider->minimumAmount->currency}}</p>

            <form method="post">
                @csrf

                @if ($provider->issuers > 0)
                    <h1>{{__('messages.sentences.choose-bank')}}</h1>
                    <div class="blocks">
                        @foreach ($provider->issuers as $method)
                            <button type="submit" name="method" value="{{$method->id}}" class="item">
                                <img class="bank" src="{{$method->image->svg}}">
                            </button>
                        @endforeach
                    </div>
                @else
                    <input type="submit">
                @endif
            </form>
        </div>
    </div>
@endsection