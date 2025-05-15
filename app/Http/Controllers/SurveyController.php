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
        $existingSurvey = Survey::where('email', $request->email)->first();
        
        if ($existingSurvey) {
            return redirect()->route('completed', ['status' => 'already_submitted']);
        }
        
        if ($request->best_comm === 'other' && $request->has('best_comm_custom')) {
            $request->merge(['best_comm' => $request->best_comm_custom]);
        }
        
        $validated = $request->validate([
            'email' => 'required|email|unique:survey,email',
            'effective_comm' => 'required',
            'best_comm' => 'required',
            'rate_comm_quality' => 'required|integer|min:1|max:5',
            'rate_events' => 'required|integer|min:1|max:5',
            'events_morale' => 'required',
            'events_culture' => 'required',
            'events_content' => 'required',
            'events_interest' => 'required',
            'events_organize' => 'required|integer|min:1|max:5',
            'culture_env' => 'required',
            'env_comfort' => 'required',
            'env_resources' => 'required',
        ], [
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',
            'email.required' => 'يرجى إدخال البريد الإلكتروني.',
            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة.',
        ]);

        Survey::create($validated);

        return redirect()->route('completed', ['status' => 'success']);
    }
    
    public function completed(Request $request)
    {
        $status = $request->query('status', 'success');
        return view('completed', compact('status'));
    }

    public function showSurveyCharts()
    {
        $surveys = Survey::all();
        $labels = [
            'effective_comm'    => 'هل قنوات التواصل فعالة',
            'best_comm'         => 'أفضل قناة تواصل',
            'rate_comm_quality' => 'تقييم جودة التواصل',
            'rate_events'       => 'تقييم الفعاليات',
            'events_morale'     => 'تعزيز الروح المعنوية',
            'events_culture'    => 'تعكس ثقافة الشركة',
            'events_content'    => 'محتوى الفعاليات',
            'events_interest'   => 'تلبية اهتمامات الموظفين',
            'events_organize'   => 'تقييم التنظيم',
            'culture_env'       => 'بيئة العمل',
            'env_comfort'       => 'راحة المكان',
            'env_resources'     => 'توفر الموارد',
        ];
        return view('chart', compact('surveys', 'labels'));
    }

    public function logs()
    {
        $surveys = Survey::all();

        $labels = [
            'whatsapp'    => 'واتس أب',
            'screens'     => 'الشاشات',
            'email'       => 'البريد الإلكتروني',
            'other'       => 'غير ذلك',
            'excellent'   => 'ممتاز',
            'good'        => 'جيد',
            'average'     => 'متوسط',
            'poor'        => 'ضعيف',
            'yes'         => 'نعم',
            'no'          => 'لا',
            '1'           => '1',
            '2'           => '2',
            '3'           => '3',
            '4'           => '4',
            '5'           => '5',
        ];

        return view('logs', compact('surveys', 'labels'));
    }
}