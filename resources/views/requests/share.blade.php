@extends('layout/master')

@section('title', "MoneyQ - Home")

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
                <p>{{__('messages.words.description')}}: {{$request->description}}</p>
                <div class="formline">
                 <input id="toCopy" type="text" value="{{(url('/'))}}/pay/{{$request->id}}" readonly>
                  <div class="margin-top">
                      <a class="button small" onclick="copyText()">{{__('messages.buttons.copy')}}</a>
                  </div>
                </div>
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="formline">
                        <label for="quantity">{{__('messages.words.email')}}</label>
                        <input type="text" name="email" id="email">
                    </div>
                    <div class="formline">
                        <label for="quantity">{{__('messages.sentences.email-lang')}}</label>
                        <select  name="lang" id="lang"><option value="nl">Nederlands</option> <option value="en">English</option> </select>
                    </div>
                    <div class="margin-top">
                        <input type="submit" style="margin: 5px; width: initial;" class="button small"
                               value="{{__('messages.buttons.sharerequest')}}" href="">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection