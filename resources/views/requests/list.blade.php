@extends('layout/master')

@section('title', "MoneyQ - Home")

@section('content')
    <a href="{{route('home')}}" class="title">MoneyQ</a>
    <div class="wrapper">

        <div class="column block">
            <div class="list wide">
                @if($requests->count() > 0)
                    @foreach ($requests as $request)
                        <a href="{{route('request', ["id"=>$request->id])}}"
                           class="item <?php if (!$request->active) echo "disabled"; ?>">
                            <div class="primary text-purple text-bold">{{$request->description}} -
                                &euro;{{$request->amount}}<?php if (!$request->active) echo " - " . __('messages.words.disabled'); ?></div>
                            <div class="secondary">{{$request->bank_iban}}</div>
                        </a>
                    @endforeach
                @else
                    <p>{{__('messages.sentences.norequests')}}</p>
                @endif
            </div>
        </div>
    </div>
@endsection