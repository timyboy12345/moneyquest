@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('head')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection

@section('content')
    <a href="{{route('home')}}" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block wide">
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert red">{{ $error }}</div>
                @endforeach
            @endif

            <form method="post" autocomplete="off">
                @csrf
                @for ($i = 0; $i < $payments; $i++)
                    <div class="formline">
                        <label for="payment_{{$i}}">{{__('messages.button.date')}}</label>
                        <input class="datepicker" autofocus value="{{old("payment.${i}")}}" type="text"
                               name="payment[]" id="payment_{{$i}}">

                        @if ($errors->has('payment'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('payment') }}</strong>
                            </span>
                        @endif
                    </div>
                @endfor

                <input type="submit" value="{{__('messages.buttons.continue')}}">
            </form>

            {{--{!! $calendar->calendar() !!}--}}
            {{--{!! $calendar->script() !!}--}}
        </div>
    </div>


    <script>
        $(function () {
            $(".datepicker").datepicker({
                minDate: 1
            });
        });
    </script>
@endsection