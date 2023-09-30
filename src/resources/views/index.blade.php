@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="attendance__alert">
    <p class="attendance__user-message"><?php $user = Auth::user(); ?>{{$user->name}}さんお疲れ様です！</p>
</div>

<div class="attendance__content">
    <div class="attendance__panel">
        <form class="attendance__button" action="/create" method="POST">
            @csrf
            <input class="attendance__button-submit" type="submit" name="start_work" value="勤務開始"></input>
            <div class="alert__message">@if(session('message'))
                {{ session('message')}}
                @endif
                @if(session('error'))
                {{session('error')}}
                @endif
            </div>
        </form>
        <form class="attendance__button" action="/update" method="POST">
            @csrf
            @method('PATCH')
            <input class="attendance__button-submit" name="end_work" type="submit" value="勤務終了"></input>
            <div class="alert__message">@if(session('message1'))
                {{ session('message1')}}
                @endif
                @if(session('error1'))
                {{session('error1')}}
                @endif
            </div>
        </form>
        <form class="rest__button" action='/rest/create' method="POST">
            @csrf
            <input class="rest__button-submit" type="submit" name="rest_start" value="休憩開始"></input>
            <div class="alert__message">@if(session('rest_start_message'))
                {{ session('rest_start_message')}}
                @endif
                @if(session('error'))
                {{session('error')}}
                @endif
            </div>
        </form>
        <form class="rest__button" action="/rest/update" method="POST">
            @csrf
            @method('PATCH')
            <input class="rest__button-submit" name="rest_end" type="submit" value="休憩終了"></input>
            <div class="alert__message">@if(session('rest_end_message'))
                {{ session('rest_end_message')}}
                @endif
                @if(session('rest_end_error'))
                {{session('rest_end_error')}}
                @endif
            </div>
    </div>
</div>
</div>
@endsection