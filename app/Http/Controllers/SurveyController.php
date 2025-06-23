<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SurveyController extends Controller
{
    public function create()
    {
        return view('survey');
    }

    public function checkEmployee(Request $request)
    {
        try {
            $validated = $request->validate([
                'employee_id' => 'required|string',
                'language' => 'sometimes|string|in:ar,en' // Add language parameter
            ]);

            $employeeCode = $validated['employee_id'];
            $language = $validated['language'] ?? 'ar'; // Default to Arabic

            $employee = Employee::where('employee_code', $employeeCode)->first();

            if ($employee) {
                $hasSurvey = Survey::where('employee_id', $employee->id)->exists();

                // Choose name based on language
                if ($language === 'en') {
                    // English: Use first_name + last_name
                    $employeeName = trim($employee->first_name . ' ' . $employee->last_name);
                } else {
                    // Arabic: Use arabic_name, fallback to English if not available
                    $employeeName = $employee->arabic_name ?? trim($employee->first_name . ' ' . $employee->last_name);
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
            // Validate employee_id input first (this is actually employee_code from frontend)
            $idValidation = $request->validate([
                'employee_id' => 'required|string',
            ], [
                'employee_id.required' => $language === 'ar' ? 'يرجى إدخال رقم الموظف.' : 'Please enter your employee code.',
                'employee_id.string' => $language === 'ar' ? 'رقم الموظف يجب أن يكون نصاً صحيحاً.' : 'Employee code must be valid.',
            ]);

            // Find employee by employee_code instead of id
            $employee = Employee::where('employee_code', $request->employee_id)->first();

            if (!$employee) {
                return redirect()->back()->withErrors([
                    'employee_id' => $language === 'ar'
                        ? 'الموظف غير موجود في النظام.'
                        : 'Employee not found in the system.'
                ])->withInput();
            }

            // Check if employee already has a survey (using the actual database id)
            $existingSurvey = Survey::where('employee_id', $employee->id)->exists();

            if ($existingSurvey) {
                return redirect()->route('completed', [
                    'status' => 'already_submitted',
                    'lang' => $language
                ]);
            }

            // Validate survey data using the model's validation rules
            $validated = $request->validate(
                Survey::validationRules($language),
                Survey::validationMessages($language)
            );

            // Add the actual employee id (not employee_code) to the survey data
            $validated['employee_id'] = $employee->id;

            // Create the survey
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
        // For viewing all surveys (separated from create)
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

    public function showSurveyCharts()
    {
        // Get surveys with employee data for charts
        $surveys = Survey::with('employee')->get()->map(function ($survey) {
            return [
                'employee_id' => $survey->employee->id,
                'employee_code' => $survey->employee->employee_code,
                'employee_name' => $survey->employee->arabic_name ?? ($survey->employee->first_name . ' ' . $survey->employee->last_name),
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

        return view('chart', compact('surveys', 'labels'));
    }

    public function logs()
    {
        // Get surveys with employee data for logs view
        $surveys = Survey::with('employee')->get()->map(function ($survey) {
            return (object) [
                'employee_id' => $survey->employee->id,
                'employee_code' => $survey->employee->employee_code,
                'employee_name' => $survey->employee->arabic_name ?? ($survey->employee->first_name . ' ' . $survey->employee->last_name),
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

        return view('logs', compact('surveys', 'labels'));
    }

    // Additional helper method for statistics
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
