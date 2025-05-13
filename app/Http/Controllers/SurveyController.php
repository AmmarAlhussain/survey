<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function create()
    {
        return view('survey');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:survey,email',
            'effective_comm' => 'required',
            'best_comm' => 'required',
            'rate_comm_quality' => 'required',
            'rate_events' => 'required',
            'events_morale' => 'required',
            'events_culture' => 'required',
            'events_content' => 'required',
            'events_interest' => 'required',
            'events_organize' => 'required',
            'culture_env' => 'required',
            'env_comfort' => 'required',
            'env_resources' => 'required',
            'stars' => 'required|integer|min:1|max:5',
        ], [
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',
            'email.required' => 'يرجى إدخال البريد الإلكتروني.',
            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة.',
        ]);

        Survey::create($validated);

        return redirect()->back()->with('success', 'تم إرسال الاستبيان بنجاح');
    }

    public function showSurveyCharts()
    {
        $fields = [
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
            'stars'
        ];

        $data = [];
        foreach ($fields as $col) {
            $data[$col] = Survey::groupBy($col)
                ->selectRaw("$col, COUNT(*) as count")
                ->pluck('count', $col)
                ->toArray();
        }

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
            'stars'             => 'تقييم الاستبيان'
        ];

        return view('chart', compact('data', 'labels'));
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

    return view('logs', compact('surveys','labels'));
}

}
