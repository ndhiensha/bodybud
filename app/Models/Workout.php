<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    protected $primaryKey = 'workout_id';

    protected $fillable = [
        'workout_name',
        'kategori',
        'deskripsi',
        'kalori',
        'durasi',
        'difficulty',
        'total_sets',
    ];

    // Relationships
    public function progresses()
    {
        return $this->hasMany(Progress::class, 'workout_id');
    }
}