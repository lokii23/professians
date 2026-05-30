<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'result_id',
        'question_id',
        'student_answer',
        'is_correct'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function result()
    {
        return $this->belongsTo(Result::class);
    }
}
