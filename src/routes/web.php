<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RestController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::get('/attendance', [AttendanceController::class, 'getAttendance']);
});

//出勤、退勤
Route::post('/create', [AttendanceController::class, 'create']);
Route::get('/update', [AttendanceController::class, 'update']);
Route::patch('/update', [AttendanceController::class, 'update']);
//休憩
Route::post('/rest/create', [RestController::class, 'create']);
Route::get('/rest/update', [RestController::class, 'update']);
Route::patch('/rest/update', [RestController::class, 'update']);


//勤務時間表示
