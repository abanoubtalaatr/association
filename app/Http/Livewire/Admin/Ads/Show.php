<?php

namespace App\Http\Livewire\Admin\Ads;

use App\Models\Ad;
use Livewire\Component;

class Show extends Component{

    public $ad,$statuses,$new_status;
    public function mount(Ad $ad){
        $this->ad = $ad;
    }

    public function render(){
        $data = [
            'record'=>$this->ad,
            'page_title'=>$this->ad->title
        ];
        return view('livewire.admin.ads.show',$data)->layout('layouts.admin');
    }
}
