<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Rest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
