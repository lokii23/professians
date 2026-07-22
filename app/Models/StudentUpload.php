<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentUpload extends Model
{
    protected $fillable = [

        'exam_id',

        'question_id',

        'user_id',

        'file'

    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}