<?php

namespace App\Http\Livewire\Admin\Discount;

use App\Models\Discount;
use App\Models\Slider;
use Livewire\Component;

class Delete extends Component{
    public function mount(Discount $discount){
        $discount->delete();
        return redirect()->to(route('admin.discount'))->with('success_message',(__('site.discount_deleted_successfully')));
    }
}
