<?php

namespace App\Http\Livewire\Admin\Discount;

use App\Models\Discount;
use App\Models\Slider;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Validator;
use App\Http\Livewire\Traits\ValidationTrait;

class Edit extends Component{
    use WithFileUploads,ValidationTrait;

    public $form,$page_title,$picture;
    public function mount(Discount $discount){
        $this->discount = $discount;
        $this->form = Arr::except($discount->toArray(),['updated_at','created_at','id']);
        $this->page_title = __('site.edit_discount');
    }

    public function store(){
        $this->validate();

        $this->discount->update($this->form);
        session()->flash('success_message',__('site.discount_edited_successfully'));
        return redirect()->to(route('admin.discount'));
    }

    public function getRules(){
        return [
            'form.discount_code'=>['required','min:3','max:15','unique:discounts,discount_code,'.$this->discount->id.',id'],
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
