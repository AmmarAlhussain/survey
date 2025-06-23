<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'employee_id',
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

    // Relationship with employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // Validation rules for easy reuse
    public static function validationRules($language = 'ar')
    {
        return [
            'work_environment_satisfaction' => 'required|in:very_satisfied,satisfied,neutral,unsatisfied',
            'work_entertainment_balance' => 'required|in:yes,neutral,no',
            'activities_help_routine' => 'required|in:yes,neutral,no',
            'activities_suggestions' => 'nullable|string|max:1000',
            'events_variety_satisfaction' => 'required|in:satisfied,neutral,unsatisfied',
            'employee_experience_satisfaction' => 'required|in:satisfied,neutral,unsatisfied',
            'communication_channels_satisfaction' => 'required|in:satisfied,neutral,unsatisfied',
            'communication_suggestions' => 'nullable|string|max:1000',
            'content_design_satisfaction' => 'required|in:satisfied,neutral,unsatisfied',
            'response_time_satisfaction' => 'required|in:satisfied,neutral,unsatisfied',
            'communication_improvement_suggestions' => 'nullable|string|max:1000',
            'work_environment_improvement_suggestions' => 'nullable|string|max:1000',
            'events_improvement_suggestions' => 'nullable|string|max:1000',
        ];
    }

    // Validation messages for easy reuse
    public static function validationMessages($language = 'ar')
    {
        $messages = [
            'ar' => [
                'work_environment_satisfaction.required' => 'الرجاء اختيار إجابة لمدى الرضا عن بيئة العمل.',
                'work_entertainment_balance.required' => 'الرجاء اختيار إجابة للتوازن بين العمل والترفيه.',
                'activities_help_routine.required' => 'الرجاء اختيار إجابة حول الأنشطة والروتين.',
                'events_variety_satisfaction.required' => 'الرجاء اختيار إجابة للرضا عن تنوع الفعاليات.',
                'employee_experience_satisfaction.required' => 'الرجاء اختيار إجابة للرضا عن تجربة الموظف.',
                'communication_channels_satisfaction.required' => 'الرجاء اختيار إجابة للرضا عن قنوات التواصل.',
                'content_design_satisfaction.required' => 'الرجاء اختيار إجابة للرضا عن تصميم المحتوى.',
                'response_time_satisfaction.required' => 'الرجاء اختيار إجابة للرضا عن سرعة الاستجابة.',
            ],
            'en' => [
                'work_environment_satisfaction.required' => 'Please select your work environment satisfaction level.',
                'work_entertainment_balance.required' => 'Please select your work-entertainment balance preference.',
                'activities_help_routine.required' => 'Please select your opinion about activities helping with routine.',
                'events_variety_satisfaction.required' => 'Please select your events variety satisfaction level.',
                'employee_experience_satisfaction.required' => 'Please select your employee experience satisfaction level.',
                'communication_channels_satisfaction.required' => 'Please select your communication channels satisfaction level.',
                'content_design_satisfaction.required' => 'Please select your content design satisfaction level.',
                'response_time_satisfaction.required' => 'Please select your response time satisfaction level.',
            ]
        ];

        return $messages[$language] ?? $messages['ar'];
    }
}
