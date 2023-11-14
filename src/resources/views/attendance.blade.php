@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
<div class="search-date">
    <form action="hashtag" method="GET">
        <input type="date" name="until" placeholder="until_date">
        <button type="submit">検索</button>
    </form>
</div>

<div class="attendance-date_table">
    <table class="attendance-date__item">
        <tr class="attendance-table__row">
            <th>名前</th>
            <th>勤務開始</th>
            <th>勤務終了</th>
            <th>休憩時間</th>
            <th>勤務時間</th>
        </tr>
        @foreach($adjustAttendances as $attendance)
        <tr>
            <td>{{$attendance->user->name}}
            </td>
            <td>{{\Carbon\Carbon::parse($attendance->start_work)->format('H:i:s')}}</td>
            <td>{{\Carbon\Carbon::parse($attendance->end_work)->format('H:i:s')}}</td>
            @endforeach
        </tr>
    </table>
    {{ $adjustAttendances->links('pagination::default') }}
</div>


@endsection