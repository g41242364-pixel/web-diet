<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['user_id', 'judul', 'isi', 'gambar', 'rekomendasi_imt'];

    public function penulis()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
