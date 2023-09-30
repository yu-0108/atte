@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
<form action="hashtag" method="GET">
    <input type="date" name="until" placeholder="until_date">
    <button type="submit">検索</button>
</form>


@endsection