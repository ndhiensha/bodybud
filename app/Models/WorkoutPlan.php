<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkoutPlan extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'workout_plans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'workout_date',
        'workout_type',
        'duration',
        'notes',
        'is_completed',
        'completed_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'workout_date' => 'date',
        'is_completed' => 'boolean',
        'completed_at' => 'datetime',
        'duration' => 'integer'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'deleted_at'
    ];

    /**
     * Get the user that owns the workout plan.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include upcoming workouts.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('workout_date', '>=', now()->toDateString())
                    ->where('is_completed', false);
    }

    /**
     * Scope a query to only include past workouts.
     */
    public function scopePast($query)
    {
        return $query->where('workout_date', '<', now()->toDateString());
    }

    /**
     * Scope a query to only include completed workouts.
     */
    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }

    /**
     * Scope a query to only include incomplete workouts.
     */
    public function scopeIncomplete($query)
    {
        return $query->where('is_completed', false);
    }

    /**
     * Scope a query to filter by workout type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('workout_type', $type);
    }

    /**
     * Get the workout type class for CSS styling.
     */
    public function getTypeClassAttribute()
    {
        return 'type-' . strtolower(str_replace(' ', '-', str_replace('Workout', '', $this->workout_type)));
    }

    /**
     * Get formatted date.
     */
    public function getFormattedDateAttribute()
    {
        return $this->workout_date->locale('id')->isoFormat('dddd, D MMMM YYYY');
    }

    /**
     * Check if workout is overdue.
     */
    public function getIsOverdueAttribute()
    {
        return $this->workout_date->isPast() && !$this->is_completed;
    }

    /**
     * Get status label.
     */
    public function getStatusAttribute()
    {
        if ($this->is_completed) {
            return 'Selesai';
        }
        
        if ($this->is_overdue) {
            return 'Terlewat';
        }

        if ($this->workout_date->isToday()) {
            return 'Hari Ini';
        }

        if ($this->workout_date->isTomorrow()) {
            return 'Besok';
        }

        return 'Dijadwalkan';
    }
}