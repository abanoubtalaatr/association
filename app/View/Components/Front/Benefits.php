<?php

namespace App\View\Components\Front;

use App\Models\Page;
use Illuminate\View\Component;

class Benefits extends Component{
    public $pages;
    public function __construct(){
        $this->pages = Page::whereType('benifits')->get();
    }


    public function render(){
        return view('components.front.benefits');
    }
}
