<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Rest;

class RestController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        Rest::create([
            'user_id' => $user->id,
            'rest_start' => Carbon::now(),
        ]);
        return redirect('/')->with('rest_start_message','休憩開始が打刻されました');
        
    }


    public function update()
    {
        $user = Auth::user();
        $timestamp = Rest::where('user_id', $user->id)->latest()->first();

        if (!empty($timestamp->rest_end)) {
            return redirect('/')->with('rest_end_error', '既に退勤の打刻がされているか、出勤打刻されていません');
        }
        $timestamp->update([
            'rest_end' => Carbon::now()
        ]);

        return redirect('')->with('rest_end_message','休憩終了が打刻されました');
    }
}