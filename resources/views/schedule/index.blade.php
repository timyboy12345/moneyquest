@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('head')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@endsection

@section('content')
    <a href="{{route('home')}}" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">
            {{ucfirst($request->user->username)}} {{__('messages.pay.is-asking')}}
            <b>{{$request->amount}}</b> {{__('messages.pay.for')}} {{$request->description}}
        </div>
        <div class="block">
            <form method="post">
                @csrf

                <div class="formline">
                    <label for="payments">{{__('messages.sentences.number-of-payments')}}</label>
                    <input autofocus value="{{old('payments')}}" type="number" name="payments" id="payments">

                    @if ($errors->has('payments'))
                        <div class="alert red">
                            {{ $errors->first('payments') }}
                        </div>
                    @endif
                </div>

                <div class="formline">
                    <label for="interval">{{__('messages.sentences.interval')}}</label>
                    <input autofocus value="{{old('interval')}}" type="number" name="interval" id="interval">

                    @if ($errors->has('interval'))
                        <div class="alert red">
                            {{ $errors->first('interval') }}
                        </div>
                    @endif
                </div>

                @if ($mandate == null)
                    <div class="formline">
                        <label for="iban">{{__('messages.buttons.iban')}}</label>
                        <input value="{{old('interval')}}" type="text" name="iban" id="iban">

                        @if ($errors->has('iban'))
                            <div class="alert red">
                                {{ $errors->first('iban') }}
                            </div>
                        @endif
                    </div>
                @else
                    <p>Je hebt al eens toestemming gegeven aan ons om geld af te schrijven</p>
                @endif

                <input type="submit" class="button">
            </form>
        </div>
    </div>
@endsection