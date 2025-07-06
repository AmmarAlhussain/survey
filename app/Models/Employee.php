<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    /**
     * Disable timestamps
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'employee_code',
        'first_name',
        'arabic_name',
    ];


    // Relationship with surveys
    public function surveys()
    {
        return $this->hasMany(Survey::class);
    }

    // Helper method to get full name
    public function getFullNameAttribute()
    {
        return $this->first_name;
    }

    // Helper method to get display name (Arabic if available, otherwise English)
    public function getDisplayNameAttribute()
    {
        return $this->arabic_name ?: $this->getFullNameAttribute();
    }
}
