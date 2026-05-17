<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ScreeningAnswer extends Model
{
    protected $fillable = ['screening_id', 'question_id', 'question_option_id'];

    public function screening()
    {
        return $this->belongsTo(Screening::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function option()
    {
        return $this->belongsTo(QuestionOption::class, 'question_option_id');
    }
}
