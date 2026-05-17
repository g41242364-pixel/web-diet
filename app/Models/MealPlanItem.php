<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MealPlanItem extends Model
{
    protected $fillable = ['meal_plan_id', 'food_id', 'porsi'];

    public function mealPlan()
    {
        return $this->belongsTo(MealPlan::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
