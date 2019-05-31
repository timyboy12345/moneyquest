@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('head')

@endsection

@section('content')
    <a href="{{route('home')}}" class="title">MoneyQ</a>

    <script type="text/javascript">
        function copyText() {
            var copyText = document.getElementById("toCopy");
            copyText.select();
            document.execCommand("copy");
        }
    </script>
    <div class="wrapper">
        <div class="column">
            <div class="block">
                <h3 class="text-center">{{__('messages.words.request')}}</h3>
                <p>{{$request->description}}</p>

                <input class="copyinput" id="toCopy" type="text" value="{{env('NGROK_ADDRESS')}}/pay/{{$request->id}}" readonly>
                <a class="button small" onclick="copyText()">Copy text</a>
            </div>
        </div>
    </div>
@endsection