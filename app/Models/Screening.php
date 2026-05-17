<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    protected $fillable = ['user_id', 'berat_badan', 'tinggi_badan', 'imt', 'status_imt', 'total_skor', 'status_kebiasaan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(ScreeningAnswer::class);
    }
}
