<?php

namespace App\Http\Controllers\Api;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;

class SliderController extends Controller
{
    public function __invoke()
    {
        return SliderResource::collection(Slider::orderByDesc('id')->where('is_active_in_mobile', 1)->get());
    }
}
