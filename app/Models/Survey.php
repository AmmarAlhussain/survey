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
        'effective_comm',
        'best_comm',
        'rate_comm_quality',
        'rate_events',
        'events_morale',
        'events_culture',
        'events_content',
        'events_interest',
        'events_organize',
        'culture_env',
        'env_comfort',
        'env_resources',
        'stars',
    ];
}
