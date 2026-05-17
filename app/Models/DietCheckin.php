<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DietCheckin extends Model
{
    protected $fillable = ['user_id', 'target_diet_id', 'berat_sekarang', 'catatan', 'tanggal_checkin'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function targetDiet()
    {
        return $this->belongsTo(TargetDiet::class);
    }
}
