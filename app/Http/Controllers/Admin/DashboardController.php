<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller{
    public function index(){
        $pending_count = Ad::whereStatus('reviewing')->count();
        $active_count = Ad::whereStatus('active')->count();
        $unpaid_count = Ad::whereStatus('unpaid')->count();
        return view('admin.dashboard.home',compact('pending_count','active_count','unpaid_count'));
    }
}
