<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'dob',
        'weight',
        'height',
        'phone',
        'address',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'dob' => 'date',
            'weight' => 'decimal:2',
            'height' => 'decimal:2',
        ];
    }

    /**
     * Get the user's age from date of birth
     */
    public function getAgeAttribute()
    {
        if (!$this->dob) {
            return null;
        }
        return $this->dob->age;
    }

    /**
     * Get the user's BMI (Body Mass Index)
     */
    public function getBmiAttribute()
    {
        if (!$this->weight || !$this->height) {
            return null;
        }
        
        // BMI = weight (kg) / (height (m))^2
        $heightInMeters = $this->height / 100;
        return round($this->weight / ($heightInMeters * $heightInMeters), 2);
    }

    /**
     * Get the user's profile picture URL
     */
    public function getProfilePictureUrlAttribute()
    {
        if ($this->profile_picture) {
            return asset('storage/' . $this->profile_picture);
        }
        
        // Return default avatar
        return asset('images/default-avatar.png');
    }
}