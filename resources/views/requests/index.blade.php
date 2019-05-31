@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="/" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="column column-50">
            <div class="block">
                <h3 class="text-center">{{__('messages.words.request')}}</h3>
                <form method="post">
                    @csrf

                    <div class="formline">
                        <label for="quantity">{{__('messages.words.amount')}}</label>
                        <input disabled value="{{$request->amount}}" type="number" name="quantity" id="quantity">
                    </div>

                    <div class="formline">
                        <label for=description>{{__('messages.words.description')}}</label>
                        <input disabled value="{{$request->description}}" type="text" id="description">
                    </div>

                    <div class="formline">
                        <label for=description>{{__('messages.words.state')}}</label>
                        <input disabled value="{{[__("messages.words.disabled"), __("messages.words.active")][$request->active]}}" type="text" id="description">
                    </div>
                </form>
            </div>
        </div>

        <div class="column column-50">
            <div class="block">
                <h3 class="text-center">{{__('messages.words.payments')}}</h3>
                @if ($payments->count() > 0)
                    <div class="list">
                        @foreach ($payments as $payment)
                            <div class="item">
                                {{$payment}}
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>{{__("messages.sentences.neverpaid")}}</p>
                @endif
            </div>
            <div class="buttons stretch">
                <a class="button small light" href="{{route('main')}}">{{__('messages.buttons.back')}}</a>

                @if ($request->active)
                    <a class="button small light" href="{{route('disablerequest', $request->id)}}">{{__('messages.buttons.disable')}}</a>
                @endif
            </div>
        </div>
    </div>
@endsection