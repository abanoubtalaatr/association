<?php

namespace App\Http\Livewire\Admin\Billing;

use App\Models\Ad;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component{
    use WithPagination;
    public function mount(){
        $this->page_title = __('site.billing');
    }

    public function render(){
        $records = Ad::whereNotNull('payment_info')
            ->when(request('user_id'),function($query,$user_id){
                return $query->whereUserId($user_id);
            })->paginate();
        return view('livewire.admin.billing.index',['records'=>$records])->layout('layouts.admin');
    }
}
