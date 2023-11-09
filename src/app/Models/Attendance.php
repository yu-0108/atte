<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public static function adjustAttendance($attendances)
    {
        foreach ($attendances as $index => $attendance) {
            $rests = $attendance->rests;
            $sum = 0;
            foreach ($rests as $rest) {
                $start_time = $rest->rest_start;
                $start_dt = new Carbon($start_time);
                $end_time = $rest->rest_end;
                $end_dt = new Carbon($end_time);
                $diff_seconds = $start_dt->diffInSeconds($end_dt);
                $sum = $sum + $diff_seconds;
            }
            $start_at = new Carbon($attendance->start_work);
            $end_at = new Carbon($attendance->end_work);

            $diff_start_end = $start_at->diffInSeconds($end_at);
            $diff_work = $diff_start_end - $sum;


            $res_hours = floor($sum / 3600);
            $res_minutes = floor(($sum / 60) % 60);
            $res_seconds = $sum % 60;

            $work_hours = floor($diff_work / 3600);
            $work_minutes = floor(($diff_work / 60) % 60);
            $work_seconds = $diff_work % 60;

            $time_dt = Carbon::createFromTime($res_hours, $res_minutes, $res_seconds);

            $time_work = Carbon::createFromTime($work_hours, $work_minutes, $work_seconds);

            $attendances[$index]->rest_sum = $time_dt->toTimeString();
            $attendances[$index]->work_time = $time_work->toTimeString();
        }
        return $attendances;
    }
}
