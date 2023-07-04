<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ad;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller{
    public function index(){
        $coursesNumber = Course::count();
        $active_count = Ad::whereStatus('active')->count();
        $unpaid_count = Ad::whereStatus('unpaid')->count();
        return view('admin.dashboard.home',compact('coursesNumber','active_count','unpaid_count'));
    }
}
