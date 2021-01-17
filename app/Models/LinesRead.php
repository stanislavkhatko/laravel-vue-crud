<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinesRead extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::created(function ($model) {
            Transaction::create(['type' => 'line', 'amount' => 1, 'user_id' => $model->user_id]);
        });
    }
}
