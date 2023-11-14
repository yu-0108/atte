<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'start_work', 'end_work'];
    //ユーザー関連づけ
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rests()
    {
        return $this->hasMany(Rest::class);
    }
    public static function getAttendance()
    {
        $id = Auth::id();

        $dt = new Carbon();
        $start_work = $dt->toDateString();

        $attendance = Attendance::where('user_id', $id)->where('start_work', $start_work)->first();

        return $attendance;
    }

    public static function adjustAttendance($attendances)
    {
        foreach ($attendances as $index => $attendance) {
            $sum = 0;
            //attendance差分表示
            $start_at = new Carbon($attendance->start_work);
            $end_at = new Carbon($attendance->end_work);

            $diff_start_end = $start_at->diffInSeconds($end_at);
            $diff_work = $diff_start_end - $sum;

            $work_hours = floor($diff_work / 3600);
            $work_minutes = floor(($diff_work / 60) % 60);
            $work_seconds = $diff_work % 60;

            $time_work = Carbon::createFromTime($work_hours, $work_minutes, $work_seconds);

            $attendances[$index]->work_time = $time_work->toTimeString();
        }
        return $attendances;
    }
}
