<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    protected $fillable = [
        'nama',
        'kalori',
        'protein',
        'karbohidrat',
        'lemak',
        'gambar'
    ];

    public function mealPlanItems()
    {
        return $this->hasMany(MealPlanItem::class);
    }
}
