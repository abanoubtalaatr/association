<?php

namespace App\View\Components\Front;

use App\Models\Partner;
use Illuminate\View\Component;

class Clients extends Component{
    public $partners;
    public function __construct(){
        $this->partners = Partner::get();
    }


    public function render(){
        return view('components.front.clients');
    }
}
