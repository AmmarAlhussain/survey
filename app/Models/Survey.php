<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $table = 'survey';
    public $timestamps = false;

    protected $fillable = [
        'email', 
        'age_range', 
        'gender', 
        'satisfaction', 
        'usage_frequency', 
        'stars', 
    ];

}
