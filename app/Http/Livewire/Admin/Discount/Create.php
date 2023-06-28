<?php

namespace App\Http\Livewire\Admin\Discount;

use App\Models\Discount;
use App\Models\Slider;
use Google\Service\Compute\Rule;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Validator;
use App\Http\Livewire\Traits\ValidationTrait;

class Create extends Component{
    use WithFileUploads,ValidationTrait;

    public $form,$page_title,$picture,$discount_type;
    public function mount(){
        $this->page_title = __('site.create_discount');
    }

    public function store(){
        $this->validate();
        Discount::create($this->form);
        session()->flash('success_message',__('site.discount_created_successfully'));
        return redirect()->to(route('admin.discount'));
    }

    public function getRules(){
        return [
            'form.discount_code'=>'required|max:15|unique:discounts,discount_code|min:3',
            'form.start_at'=>'required|date|after:yesterday',
            'form.expire_at'=>'required|date|after:form.start_at',
            'form.number_of_times'=>'required|numeric|min:1|max:100',
            'form.type'=>['required', \Illuminate\Validation\Rule::in('value','percentage')],
            'form.value'=>'required|numeric',
        ];
    }
    public function render(){
        return view('livewire.admin.discount.create')->layout('layouts.admin');
    }
}
