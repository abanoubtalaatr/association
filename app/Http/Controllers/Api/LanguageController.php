<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeLanguageRequest;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function update(ChangeLanguageRequest $request){
        auth('api-users')->user()->update(['default_language'=>$request->default_language]);
        return response()->json(['status'=>1]);
    }
}
