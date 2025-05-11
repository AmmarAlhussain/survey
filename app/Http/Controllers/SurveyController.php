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
            'age_range' => 'required|in:under_18,18_24,25_34,35_44,45_plus',
            'gender' => 'required|in:male,female',
            'satisfaction' => 'required|in:very_satisfied,satisfied,neutral,dissatisfied,very_dissatisfied',
            'usage_frequency' => 'required|in:daily,weekly,monthly,rarely,never',
            'stars' => 'required|in:1-star,2-star,3-star,4-star,5-star',
        ]);

        Survey::create([
            'email' => $request->email,
            'age_range' => $request->age_range,
            'gender' => $request->gender,
            'satisfaction' => $request->satisfaction,
            'usage_frequency' => $request->usage_frequency,
            'stars' => $request->stars,
        ]);

        return redirect()->route('create')->with('success', 'Survey submitted successfully!');
    }

    public function showSurveyCharts()
    {
        $ageRanges = Survey::groupBy('age_range')
            ->selectRaw('age_range, count(*) as count')
            ->pluck('count', 'age_range')
            ->toArray();
    
        $satisfaction = Survey::groupBy('satisfaction')
            ->selectRaw('satisfaction, count(*) as count')
            ->pluck('count', 'satisfaction')
            ->toArray();
    
        $usageFrequency = Survey::groupBy('usage_frequency')
            ->selectRaw('usage_frequency, count(*) as count')
            ->pluck('count', 'usage_frequency')
            ->toArray();
    
            $stars = Survey::groupBy('stars')
            ->selectRaw('stars, count(*) as count')
            ->pluck('count', 'stars')
            ->toArray();
    
        $data = [
            'age_ranges' => $this->prepareData($ageRanges, ['under_18', '18_24', '25_34', '35_44', '45_plus']),
            'satisfaction' => $this->prepareData($satisfaction, ['very_satisfied', 'satisfied', 'neutral', 'dissatisfied', 'very_dissatisfied']),
            'usage_frequency' => $this->prepareData($usageFrequency, ['daily', 'weekly', 'monthly', 'rarely', 'never']),
            'stars' => $this->prepareData($stars, ['1-star','2-star','3-star','4-star','5-star']),
        ];
    
        return view('chart', compact('data'));
    }
    


    private function prepareData($data, $keys)
    {
        foreach ($keys as $key) {
            if (!isset($data[$key])) {
                $data[$key] = 0;
            }
        }
    
        $sortedData = [];
        foreach ($keys as $key) {
            $sortedData[$key] = $data[$key];
        }
    
        return $sortedData;
    }
}
