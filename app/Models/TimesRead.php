<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimesRead extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::created(function ($model) {
            Transaction::create(['type' => 'time', 'amount' => $model->minutes, 'user_id' => $model->user_id]);
        });
    }
}
