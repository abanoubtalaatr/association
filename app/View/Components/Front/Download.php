<?php

namespace App\View\Components\Front;

use App\Models\Setting;
use Illuminate\View\Component;

class Download extends Component{
    public $settings;
    public function __construct(){
        $this->settings = Setting::first();
    }

    public function render(){
        return view('components.front.download');
    }
}
