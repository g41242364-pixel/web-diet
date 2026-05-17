<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    protected $fillable = [
        'user_id', 'status_imt', 'kategori', 'tanggal',
        'total_kalori', 'total_protein', 'total_karbohidrat', 'total_lemak',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(MealPlanItem::class);
    }
}
