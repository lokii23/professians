<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'duration',
        'type',
        'passkey',
        'user_id',
        'is_active'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
