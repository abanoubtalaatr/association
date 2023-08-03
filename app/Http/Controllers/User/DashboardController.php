<?php

namespace App\Http\Controllers\User;

use App\Models\Ad;
use Illuminate\Http\Request;
use App\Services\StatsService;
use App\Models\StatsCitySoldier;
use App\Models\StatsCountrySoldier;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {

        $data = [];
        $data['country_stats'] = [];
        $data['city_stats'] = [];
        $data['week_stats'] = [];
        $data['user_type'] = 'solider';
        // dd($data['country_stats']);
        return view('front.user.advertiser_dashboard', $data);
    }

    public function courses()
    {
        $courses= auth('users')->user()->courses;
        $page_title  = __('site.courses');

        $certifications = auth('users')->user()->courses()->where('attend_course', 1)->where('pass_course', 1)->get();

        return view('front.user.courses', compact('courses', 'certifications','page_title'));
    }
}
