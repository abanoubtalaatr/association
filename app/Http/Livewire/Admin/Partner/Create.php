<?php

namespace App\Http\Livewire\Admin\Partner;

use App\Models\Partner;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Validator;
use App\Http\Livewire\Traits\ValidationTrait;

class Create extends Component{
    use WithFileUploads,ValidationTrait;

    public $form,$page_title,$image;
    public function mount(){
        $this->page_title = __('site.create_partner');
    }

    public function store(){
        $this->validate();
        $this->form['image'] = $this->image->storeAs(date('Y/m/d'),Str::random(50).'.'.$this->image->extension(),'public');
        Partner::create($this->form);
        session()->flash('success_message',__('site.partner_created_successfully'));
        return redirect()->to(route('admin.partner'));
    }


    public function updatedFormImage(){
        $this->withValidator(function (Validator $validator) {
            if($validator->errors()->has('form.image')){
                $this->form['image'] = '';
            }
        })->validateOnly('form.image');
    }


    public function getRules(){
        return [
            'form.name_ar'=>'required|max:500',
            'form.name_en'=>'required|max:500',

            'image'=>'required|file|mimes:png,jpg,jpeg|max:10240'
        ];
    }
    public function render(){
        return view('livewire.admin.partner.create')->layout('layouts.admin');
    }
}
