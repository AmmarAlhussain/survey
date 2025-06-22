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
        'work_environment_satisfaction',
        'work_entertainment_balance',
        'activities_help_routine',
        'activities_suggestions',
        'events_variety_satisfaction',
        'employee_experience_satisfaction',
        'communication_channels_satisfaction',
        'communication_suggestions',
        'content_design_satisfaction',
        'response_time_satisfaction',
        'communication_improvement_suggestions',
        'work_environment_improvement_suggestions',
        'events_improvement_suggestions',
    ];
}
