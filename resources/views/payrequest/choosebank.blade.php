@extends('layout.master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="{{route('home')}}" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">
            <form method="post">
                @csrf

                <h3 class="text-center">{{__('messages.words.request')}}</h3>
                <h1>{{__('messages.sentences.choose-bank')}}</h1>

                <div class="formline">
                    <label for=currency>{{__('messages.words.currency')}}</label>
                    <select type="text" name="currency" id="currency">
                        @foreach($currencies as $currency)
                            <option value="{{$currency['iso']}}">{{$currency['name']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="blocks">
                    @foreach ($methods->issuers as $method)
                        <button type="submit" name="bank" value="{{$method->id}}" class="item">
                            <img class="bank" src="{{$method->image->svg}}">
                        </button>
                    @endforeach
                </div>
            </form>
        </div>
    </div>
@endsection