<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
    'exam_id',
    'question',
    'question_type',
    'option_a',
    'option_b',
    'option_c',
    'option_d',
    'correct_answer'
];

public function uploads()
{
    return $this->hasMany(StudentUpload::class);
}
}
