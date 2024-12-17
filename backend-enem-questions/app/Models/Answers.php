<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    protected $fillable = [
        'question_id',
        'dsc_answer',
        'is_correct'
    ];

    public function question()
    {
        return $this->belongsTo(Questions::class, 'question_id');

    }
}
