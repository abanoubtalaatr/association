<?php

namespace App\Http\Livewire\Admin\Discount;

use App\Models\Discount;
use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $page_title;

    public function mount()
    {
        $this->page_title = __('general.discounts');
    }


    public function render()
    {
        $records = Discount::paginate();
//        dd($discounts);
        return view('livewire.admin.discount.index', compact('records'))->layout('layouts.admin');
    }
}
