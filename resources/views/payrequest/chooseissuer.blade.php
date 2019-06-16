@extends('layout.master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="{{route('home')}}" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">

            <h3 class="text-center">{{__('messages.words.request')}}</h3>
            <p>[VERTAAL MIJ!] Je gaat betalen in {{$selected_currency}}</p>
            <p>[VERTAAL MIJ!] Je gaat betalen met {{$provider->description}}</p>

            <form method="post">
                @csrf

                @if ($provider->issuers > 0)
                    <h1>{{__('messages.sentences.choose-bank')}}</h1>
                    <div class="blocks">
                        @foreach ($provider->issuers as $issuer)
                            <button title="{{$issuer->name}}" type="submit" name="issuer" value="{{$issuer->id}}" class="item">
                                <img alt="{{$issuer->name}} logo" class="bank" src="{{$issuer->image->svg}}">
                            </button>
                        @endforeach
                    </div>
                @else
                    <input type="submit">
                @endif
            </form>
        </div>

        <div class="buttons stretch">
            <a class="button light" href="{{route('home')}}">{{__('messages.buttons.cancel')}}</a>
            <a class="button light" href="{{route('pay_choosemethod', $request->id)}}">{{__('messages.buttons.back')}}</a>
        </div>
    </div>
@endsection