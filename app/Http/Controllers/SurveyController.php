<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function create()
    {
        $surveys = Survey::all();
        $existingEmails = Survey::pluck('email')->toArray();

        return view('survey', compact('surveys', 'existingEmails'));
    }

    public function store(Request $request)
    {
        $language = $request->input('language', 'ar');

        $existingSurvey = Survey::where('email', $request->email)->first();

        if ($existingSurvey) {
            return redirect()->route('completed', [
                'status' => 'already_submitted',
                'lang' => $language
            ]);
        }

        $validated = $request->validate([
            'email' => 'required|email|unique:survey,email',
            'work_environment_satisfaction' => 'required|in:very_satisfied,satisfied,neutral,unsatisfied',
            'work_entertainment_balance' => 'required|in:yes,neutral,no',
            'activities_help_routine' => 'required|in:yes,neutral,no',
            'activities_suggestions' => 'nullable|string',
            'events_variety_satisfaction' => 'required|in:satisfied,neutral,unsatisfied',
            'employee_experience_satisfaction' => 'required|in:satisfied,neutral,unsatisfied',
            'communication_channels_satisfaction' => 'required|in:satisfied,neutral,unsatisfied',
            'communication_suggestions' => 'nullable|string',
            'content_design_satisfaction' => 'required|in:satisfied,neutral,unsatisfied',
            'response_time_satisfaction' => 'required|in:satisfied,neutral,unsatisfied',
            'communication_improvement_suggestions' => 'nullable|string',
            'work_environment_improvement_suggestions' => 'nullable|string',
            'events_improvement_suggestions' => 'nullable|string',
        ], [
            'email.unique' => $language === 'ar' ? 'البريد الإلكتروني مستخدم بالفعل.' : 'Email address is already in use.',
            'email.required' => $language === 'ar' ? 'يرجى إدخال البريد الإلكتروني.' : 'Please enter your email address.',
            'email.email' => $language === 'ar' ? 'صيغة البريد الإلكتروني غير صحيحة.' : 'Invalid email format.',
            'work_environment_satisfaction.required' => $language === 'ar' ? 'الرجاء اختيار إجابة.' : 'Please select an answer.',
            'work_entertainment_balance.required' => $language === 'ar' ? 'الرجاء اختيار إجابة.' : 'Please select an answer.',
            'activities_help_routine.required' => $language === 'ar' ? 'الرجاء اختيار إجابة.' : 'Please select an answer.',
            'events_variety_satisfaction.required' => $language === 'ar' ? 'الرجاء اختيار إجابة.' : 'Please select an answer.',
            'employee_experience_satisfaction.required' => $language === 'ar' ? 'الرجاء اختيار إجابة.' : 'Please select an answer.',
            'communication_channels_satisfaction.required' => $language === 'ar' ? 'الرجاء اختيار إجابة.' : 'Please select an answer.',
            'content_design_satisfaction.required' => $language === 'ar' ? 'الرجاء اختيار إجابة.' : 'Please select an answer.',
            'response_time_satisfaction.required' => $language === 'ar' ? 'الرجاء اختيار إجابة.' : 'Please select an answer.',
        ]);

        Survey::create($validated);

        return redirect()->route('completed', [
            'status' => 'success',
            'lang' => $language
        ]);
    }

    public function completed(Request $request)
    {
        $status = $request->query('status', 'success');
        $language = $request->query('lang', 'ar');

        return view('completed', compact('status', 'language'));
    }

    public function showSurveyCharts()
    {
        $surveys = Survey::all();
        $labels = [
            'work_environment_satisfaction' => 'مدى الرضا عن بيئة العمل',
            'work_entertainment_balance' => 'التوازن بين العمل والترفيه',
            'activities_help_routine' => 'الأنشطة تساعد في التغلب على الروتين',
            'events_variety_satisfaction' => 'الرضا عن تنوع الفعاليات',
            'employee_experience_satisfaction' => 'الرضا عن دور إدارة تجربة الموظف',
            'communication_channels_satisfaction' => 'الرضا عن قنوات التواصل',
            'content_design_satisfaction' => 'الرضا عن محتوى وتصاميم الرسائل',
            'response_time_satisfaction' => 'الرضا عن سرعة الاستجابة',
        ];
        return view('chart', compact('surveys', 'labels'));
    }

    public function logs()
    {
        $surveys = Survey::all();

        $labels = [
            'very_satisfied' => 'راضي جداً',
            'satisfied' => 'راضي',
            'neutral' => 'محايد',
            'unsatisfied' => 'غير راضي',
            'yes' => 'نعم',
            'no' => 'لا',
        ];

        return view('logs', compact('surveys', 'labels'));
    }
}
