<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SleepLog extends Model
{
    protected $fillable = ['user_id', 'jam_tidur', 'jam_bangun', 'durasi_jam', 'status_tidur', 'catatan', 'tanggal'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
