<?php

namespace App\Http\Controllers\Advertiser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillingController extends Controller{
    public function index(){
        return view('front.user.billing');
    }
}
