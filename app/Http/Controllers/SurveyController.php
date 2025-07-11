<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SurveyController extends Controller
{
    /**
     * Get the list of allowed emails for accessing charts and logs
     */
    private function getAllowedEmails()
    {
        return array_map('strtolower', [
            'nourah.albugami@seera.sa',
            'sarah.fahad@seera.sa',
            'hamoud.alqhtani@seera.sa',
            'ammar.alhussain@almosafer.com',
        ]);
    }

    public function create()
    {
        return view('survey');
    }

    public function checkEmployee(Request $request)
    {
        try {
            $validated = $request->validate([
                'employee_id' => 'required|string',
                'language' => 'sometimes|string|in:ar,en'
            ]);

            $employeeCode = $validated['employee_id'];
            $language = $validated['language'] ?? 'ar';

            $employee = Employee::where('employee_code', $employeeCode)->first();

            if ($employee) {
                $hasSurvey = Survey::where('employee_id', $employee->id)->exists();

                if ($language === 'en') {
                    $employeeName = $employee->first_name
                        ? explode(' ', trim($employee->first_name))[0]
                        : 'Unknown';
                } else {
                    $employeeName = $employee->arabic_name
                        ? explode(' ', trim($employee->arabic_name))[0]
                        : explode(' ', trim($employee->first_name))[0];
                }

                return response()->json([
                    'success' => true,
                    'employee_name' => $employeeName,
                    'has_survey' => $hasSurvey
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Employee not found'
                ]);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid employee code format',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Employee check error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Server error occurred'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $language = $request->input('language', 'ar');

        try {
            $idValidation = $request->validate([
                'employee_id' => 'required|string',
            ], [
                'employee_id.required' => $language === 'ar' ? 'يرجى إدخال رقم الموظف.' : 'Please enter your employee code.',
                'employee_id.string' => $language === 'ar' ? 'رقم الموظف يجب أن يكون نصاً صحيحاً.' : 'Employee code must be valid.',
            ]);

            $employee = Employee::where('employee_code', $request->employee_id)->first();

            if (!$employee) {
                return redirect()->back()->withErrors([
                    'employee_id' => $language === 'ar'
                        ? 'الموظف غير موجود في النظام.'
                        : 'Employee not found in the system.'
                ])->withInput();
            }

            if ($request->employee_id === '90000000') {
                return redirect()->route('completed', [
                    'status' => 'success',
                    'lang' => $language
                ]);
            }

            $existingSurvey = Survey::where('employee_id', $employee->id)->exists();

            if ($existingSurvey) {
                return redirect()->route('completed', [
                    'status' => 'already_submitted',
                    'lang' => $language
                ]);
            }

            $validated = $request->validate(
                Survey::validationRules($language),
                Survey::validationMessages($language)
            );

            $validated['employee_id'] = $employee->id;

            Survey::create($validated);

            return redirect()->route('completed', [
                'status' => 'success',
                'lang' => $language
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Survey submission error: ' . $e->getMessage());
            return redirect()->back()->withErrors([
                'general' => $language === 'ar'
                    ? 'حدث خطأ أثناء حفظ الاستبيان. يرجى المحاولة مرة أخرى.'
                    : 'An error occurred while saving the survey. Please try again.'
            ])->withInput();
        }
    }

    public function completed(Request $request)
    {
        $status = $request->query('status', 'success');
        $language = $request->query('lang', 'ar');

        return view('completed', compact('status', 'language'));
    }

    public function index()
    {
        $surveys = Survey::with('employee')->get()->map(function ($survey) {
            return [
                'employee_id' => $survey->employee->id,
                'employee_code' => $survey->employee->employee_code,
                'employee_name' => $survey->employee->display_name ?? $survey->employee->arabic_name,
                'work_environment_satisfaction' => $survey->work_environment_satisfaction,
                'work_entertainment_balance' => $survey->work_entertainment_balance,
                'activities_help_routine' => $survey->activities_help_routine,
                'activities_suggestions' => $survey->activities_suggestions,
                'events_variety_satisfaction' => $survey->events_variety_satisfaction,
                'employee_experience_satisfaction' => $survey->employee_experience_satisfaction,
                'communication_channels_satisfaction' => $survey->communication_channels_satisfaction,
                'communication_suggestions' => $survey->communication_suggestions,
                'content_design_satisfaction' => $survey->content_design_satisfaction,
                'response_time_satisfaction' => $survey->response_time_satisfaction,
                'communication_improvement_suggestions' => $survey->communication_improvement_suggestions,
                'work_environment_improvement_suggestions' => $survey->work_environment_improvement_suggestions,
                'events_improvement_suggestions' => $survey->events_improvement_suggestions,
            ];
        });

        return view('surveys.index', compact('surveys'));
    }

    public function showSurveyCharts(Request $request)
    {
        $allowedEmails = $this->getAllowedEmails();
        $sessionEmail = strtolower(Session::get('chart_email', ''));

        // Check if we have an error message from redirect
        $error = session('error');
        $showForm = session('showForm', false);

        if (!$sessionEmail || !in_array($sessionEmail, $allowedEmails)) {
            return view('chart', [
                'showForm' => true,
                'error' => $error
            ]);
        }

        $surveys = Survey::with('employee')->get()->map(function ($survey) {
            return [
                'employee_id' => $survey->employee->id,
                'employee_code' => $survey->employee->employee_code,
                'employee_name' => $survey->employee->arabic_name ?? $survey->employee->first_name,
                'work_environment_satisfaction' => $survey->work_environment_satisfaction,
                'work_entertainment_balance' => $survey->work_entertainment_balance,
                'activities_help_routine' => $survey->activities_help_routine,
                'events_variety_satisfaction' => $survey->events_variety_satisfaction,
                'employee_experience_satisfaction' => $survey->employee_experience_satisfaction,
                'communication_channels_satisfaction' => $survey->communication_channels_satisfaction,
                'content_design_satisfaction' => $survey->content_design_satisfaction,
                'response_time_satisfaction' => $survey->response_time_satisfaction,
            ];
        });

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

        return view('chart', compact('surveys', 'labels'))->with('showForm', false);
    }

    public function submitChartEmail(Request $request)
    {
        $allowedEmails = $this->getAllowedEmails();
        $email = strtolower($request->input('email', ''));

        Log::info('Checking chart email: ' . $email);

        if (in_array($email, $allowedEmails)) {
            Session::put('chart_email', $email);
            return redirect()->route('charts');
        } else {
            // Store error in session and redirect
            Session::flash('error', 'البريد الإلكتروني غير مصرح له بالدخول.');
            Session::flash('showForm', true);
            return redirect()->route('charts');
        }
    }

    public function logs(Request $request)
    {
        $allowedEmails = $this->getAllowedEmails();
        $sessionEmail = strtolower($request->session()->get('logs_email', ''));

        // If no session email or session email is not in allowed emails, show form
        if (!$sessionEmail || !in_array($sessionEmail, $allowedEmails)) {
            return view('logs', [
                'showForm' => true,
                'error' => session('error') // This will get the flashed error message
            ]);
        }

        $surveys = Survey::with('employee')->get()->map(function ($survey) {
            return (object) [
                'employee_id' => $survey->employee->id,
                'employee_code' => $survey->employee->employee_code,
                'employee_name' => $survey->employee->arabic_name ?? $survey->employee->first_name,
                'work_environment_satisfaction' => $survey->work_environment_satisfaction,
                'work_entertainment_balance' => $survey->work_entertainment_balance,
                'activities_help_routine' => $survey->activities_help_routine,
                'activities_suggestions' => $survey->activities_suggestions,
                'events_variety_satisfaction' => $survey->events_variety_satisfaction,
                'employee_experience_satisfaction' => $survey->employee_experience_satisfaction,
                'communication_channels_satisfaction' => $survey->communication_channels_satisfaction,
                'communication_suggestions' => $survey->communication_suggestions,
                'content_design_satisfaction' => $survey->content_design_satisfaction,
                'response_time_satisfaction' => $survey->response_time_satisfaction,
                'communication_improvement_suggestions' => $survey->communication_improvement_suggestions,
                'work_environment_improvement_suggestions' => $survey->work_environment_improvement_suggestions,
                'events_improvement_suggestions' => $survey->events_improvement_suggestions,
                'created_at' => $survey->created_at,
            ];
        });

        $labels = [
            'very_satisfied' => 'راضي جداً',
            'satisfied' => 'راضي',
            'neutral' => 'محايد',
            'unsatisfied' => 'غير راضي',
            'yes' => 'نعم',
            'no' => 'لا',
        ];

        return view('logs', compact('surveys', 'labels'))->with('showForm', false);
    }
    public function submitLogsEmail(Request $request)
    {
        $allowedEmails = $this->getAllowedEmails();
        $email = strtolower($request->input('email', ''));

        Log::info('Checking logs email: ' . $email);

        if (in_array($email, $allowedEmails)) {
            Session::put('logs_email', $email);
            return redirect()->route('logs');
        } else {
            return redirect()->route('logs')->with([
                'error' => 'البريد الإلكتروني غير مصرح له بالدخول.',
                'showForm' => true
            ]);
        }
    }


    public function getStatistics()
    {
        $totalSurveys = Survey::count();
        $totalEmployees = Employee::count();
        $responseRate = $totalEmployees > 0 ? round(($totalSurveys / $totalEmployees) * 100, 2) : 0;

        return [
            'total_surveys' => $totalSurveys,
            'total_employees' => $totalEmployees,
            'response_rate' => $responseRate,
        ];
    }
}
