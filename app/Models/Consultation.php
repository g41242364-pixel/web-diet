<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = ['user_id', 'ahli_gizi_id', 'status', 'screening_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ahliGizi()
    {
        return $this->belongsTo(User::class, 'ahli_gizi_id');
    }

    public function screening()
    {
        return $this->belongsTo(Screening::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class)->orderBy('created_at');
    }
}
