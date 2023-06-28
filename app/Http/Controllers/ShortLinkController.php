<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;

class ShortLinkController extends Controller{
    public function show(ShortLink $short_link){
        dd($short_link);
    }
}
