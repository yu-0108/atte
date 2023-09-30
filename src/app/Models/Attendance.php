<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'start_work', 'end_work'];
    //ユーザー関連づけ
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
