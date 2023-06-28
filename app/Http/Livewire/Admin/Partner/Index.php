<?php

namespace App\Http\Livewire\Admin\Partner;

use App\Models\Partner;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component{
    use WithPagination;
    public $page_title;

    public function mount(){
        $this->page_title = __('site.partners');
    }


    public function render(){
        $records = Partner::paginate();
        return view('livewire.admin.partner.index',compact('records'))->layout('layouts.admin');
    }
}
