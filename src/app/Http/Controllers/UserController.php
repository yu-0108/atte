<?php

namespace App\Http\Controllers;

use App\Models\Attendance;

class UserController extends Controller
{
    public function index()
    {
        //データ表示
        $attendances = Attendance::with('user')->get();
        $attendances = Attendance::simplePaginate(5);
        return view('/attendance', compact('attendances'));
    }
}
