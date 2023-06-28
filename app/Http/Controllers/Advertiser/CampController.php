<?php

namespace App\Http\Controllers\Advertiser;

use App\Models\Camp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CampController extends Controller{
    public function index(){
        return view('front.user.camps.index');
    }

    public function create(){
        return view('front.user.camps.create');
    }

    public function edit(Camp $camp){
        return view('front.user.camps.edit',compact('camp'));
    }
}
