<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentGrade extends Model
{
    protected $fillable = [
        'user_id',
        'subject_id',
        'midterm_grade',
        'final_grade',
        'final_rating',
    ];

    protected $casts = [
        'midterm_grade' => 'decimal:2',
        'final_grade'   => 'decimal:2',
        'final_rating'  => 'decimal:2',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
