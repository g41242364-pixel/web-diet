<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['pertanyaan', 'fase', 'urutan'];

    public function options()
    {
        return $this->hasMany(QuestionOption::class)->orderBy('id');
    }
}
