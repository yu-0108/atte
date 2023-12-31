<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'start_work', 'end_work'];
    //ユーザー関連づけ
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
