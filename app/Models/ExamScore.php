<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamScore extends Model
{
    protected $fillable = [
        'user_id',
        'subject_id',
        'exam_name',
        'exam_type',
        'score',
        'total_score',
    ];

    protected $casts = [
        'score' => 'decimal:2',
        'total_score' => 'decimal:2',
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