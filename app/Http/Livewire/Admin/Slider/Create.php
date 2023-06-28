<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\Slider;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Validator;
use App\Http\Livewire\Traits\ValidationTrait;

class Create extends Component{
    use WithFileUploads,ValidationTrait;

    public $form,$page_title,$picture;
    public $is_active = true;
    public function mount(){
        $this->page_title = __('site.create_slider');
    }

    public function store(){

        $this->validate();
        $this->form['picture'] = $this->picture->storeAs(date('Y/m/d'),Str::random(50).'.'.$this->picture->extension(),'public');
        Slider::create($this->form);
        session()->flash('success_message',__('site.slider_created_successfully'));
        return redirect()->to(route('admin.slider'));
    }


    public function updatedFormPicture(){
        $this->withValidator(function (Validator $validator) {
            if($validator->errors()->has('form.picture')){
                $this->form['picture'] = '';
            }
        })->validateOnly('form.picture');
    }

    public function updatedIsActive($value)
    {
        $this->isActive = $value ? 1 : 0;
    }



    public function getRules(){
        return [
            'form.line1_ar'=>'required|max:500',
            'form.line1_en'=>'required|max:500',

            'form.line2_ar'=>'required|max:500',
            'form.line2_en'=>'required|max:500',

            'form.line3_ar'=>'required|max:500',
            'form.line3_en'=>'required|max:500',

            'form.button_text_ar'=>'required|max:100',
            'form.button_text_en'=>'required|max:100',
            'form.button_link_ar'=>'required|active_url',
            'form.button_link_en'=>'required|active_url',

            'picture'=>'required|file|mimes:png,jpg,jpeg|max:10240',
            'is_active' => 'boolean'
        ];
    }
    public function render(){
        return view('livewire.admin.slider.create')->layout('layouts.admin');
    }
}
