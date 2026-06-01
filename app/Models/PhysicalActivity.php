<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PhysicalActivity extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'status_kebiasaan', 'durasi', 'intensitas', 'lokasi', 'link_youtube'];
}