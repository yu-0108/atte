<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Http\Response;

class AttendanceController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        //1日１回まで
        $oldTimestamp = Attendance::where('user_id', $user->id)->latest()->first();
        if ($oldTimestamp) {
            $oldTimestampStart_Work = new Carbon($oldTimestamp->start_work);
            $oldTimestampDay = $oldTimestampStart_Work->startOfDay();
        } else {
            Attendance::create([
                'user_id' => $user->id,
                'start_work' => Carbon::now(),
            ]);

            return redirect('/')->with('message', ' 勤務開始が完了しました');
        }

        $newTimestampDay = Carbon::today();

        if (($oldTimestampDay == $newTimestampDay) && (empty($oldTimestamp->end_work))) {
            return redirect('/')->with('error', '※すでに出勤打刻がされています※');
        }

        Attendance::create([
            'user_id' => $user->id,
            'start_work' => Carbon::now(),
        ]);

        return redirect('/')->with('message', ' 勤務開始が完了しました');
    }



    public function update()
    {
        $user = Auth::user();
        $timestamp = Attendance::where('user_id', $user->id)->latest()->first();

        if (!empty($timestamp->end_work)) {
            return redirect('/')->with('error_end_work', '※既に退勤の打刻がされているか、出勤打刻されていません※');
        }
        $timestamp->update([
            'end_work' => Carbon::now()
        ]);

        return redirect('')->with('message_end_work', '退勤完了');
    }

    public function index(){
        $attendances = attendance::with('user')->get();
        return view('/attendance',compact('attendances'));
    }

}