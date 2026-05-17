<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'umur', 'jenis_kelamin', 'is_online',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_online' => 'boolean',
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isAhliGizi()
    {
        return $this->role === 'ahli_gizi';
    }

    public function isPengguna()
    {
        return $this->role === 'pengguna';
    }

    // Relasi
    public function screenings()
    {
        return $this->hasMany(Screening::class);
    }

    public function targetDiets()
    {
        return $this->hasMany(TargetDiet::class);
    }

    public function sleepLogs()
    {
        return $this->hasMany(SleepLog::class);
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function consultationsAsAhliGizi()
    {
        return $this->hasMany(Consultation::class, 'ahli_gizi_id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
