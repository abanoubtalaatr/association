<?php

namespace App\Http\Controllers\Admin;

use App\Models\Certification;
use App\Models\Course;
use App\Models\User;
use App\Http\Controllers\Controller;

class DashboardController extends Controller{
    public function index(){
        $coursesNumber = Course::count();
        $certifications_count = Certification::count();
        $trainers = User::count();
        return view('admin.dashboard.home',compact('coursesNumber','certifications_count','trainers'));
    }
}
