<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $fillable = [
        'category',
        'name',
        'description',
        'calories',
        'duration',
        'repetitions',
        'step_order'
    ];

    public function getDurationInMinutesAttribute()
    {
        return ceil($this->duration / 60);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category)->orderBy('step_order');
    }
}