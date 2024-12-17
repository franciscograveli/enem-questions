<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $fillable = [
        'dsc_question',
        'category'
    ];

    public function answers()
    {
        return $this->hasMany(Answers::class, 'question_id');
    }
}
