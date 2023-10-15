<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Rest;
use App\Models\User;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $attendances = $request->attendance;
        $rests = $request->rest;
        $attendances = Attendance::with(['user:id,name', 'user.rest:id,rest_start'])->orderBy('id', 'asc')->paginate(5);

        return view('/attendance', [
            'attendance' => $attendances,
        ]);
    }
}
