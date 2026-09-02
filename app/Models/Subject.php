<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
    ];

    public function grades(): HasMany
    {
        return $this->hasMany(StudentGrade::class);
    }
    public function examScores()
    {
        return $this->hasMany(ExamScore::class);
    }
}
