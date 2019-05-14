@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="/" class="title">MoneyQ</a>
    <div class="wrapper">
        <div class="block">
            <h3 class="text-center">{{__('messages.words.request')}}</h3>
            <div class="articleflex">
                <div class="article">
                    <div class="blockborder">
                        <h1>piet vraag 5€ voor "een pilsie"</h1>
                        <div class="buttons">
                            <a class="button large" href="{{route('step2')}}">{{__('messages.buttons.ok')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection