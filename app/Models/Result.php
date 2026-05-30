<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_id',
        'score'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function exam()
    {
        return $this->belongsTo(\App\Models\Exam::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
