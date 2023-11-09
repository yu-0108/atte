<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rest extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'rest_start', 'rest_end'];
    //ユーザー関連づけ
}
