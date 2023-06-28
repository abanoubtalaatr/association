<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Resources\AdResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\BillingResource;

class BillingController extends Controller{
    public function index(Request $request){
        return AdResource::collection(auth('api-users')->user()->ads()->whereNotNull('payment_info')->paginate());
    }
}
