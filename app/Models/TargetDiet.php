<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TargetDiet extends Model
{
    protected $fillable = ['user_id', 'berat_target', 'target_mingguan', 'tujuan', 'berat_awal'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checkins()
    {
        return $this->hasMany(DietCheckin::class)->orderBy('tanggal_checkin', 'desc');
    }
}
