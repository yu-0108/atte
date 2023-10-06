<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Rest;

use function PHPUnit\Framework\assertNotEmpty;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class RestController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        //休憩終了押してないとエラー
        $oldTimestamp = Rest::where('user_id', $user->id)->latest()->first();
        if (empty($oldTimestamp->rest_end)) {
            return redirect('/')->with('rest_start_error', 'すでに休憩開始打刻されています');
        }

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
            return redirect('/')->with('rest_end_error', '既に休憩終了の打刻がされているか、開始がされていません');
        }
        $timestamp->update([
            'rest_end' => Carbon::now()
        ]);

        return redirect('')->with('rest_end_message','休憩終了が打刻されました');
    }
}