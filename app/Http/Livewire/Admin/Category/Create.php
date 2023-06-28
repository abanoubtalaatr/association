<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Validator;
use App\Http\Livewire\Traits\ValidationTrait;

class Create extends Component{
    use WithFileUploads,ValidationTrait;

    public $form,$page_title,$picture;
    public function mount(){
        $this->page_title = __('site.create_category');
    }

    public function store(){
        $this->validate();
        $this->form['picture'] = $this->picture->storeAs(date('Y/m/d'),Str::random(50).'.'.$this->picture->extension(),'public');
        Category::create($this->form);
        session()->flash('success_message',__('site.created_successfully'));
        return redirect()->to(url('admin/category'));
    }


    public function updatedFormPicture(){
        $this->withValidator(function (Validator $validator) {
            if($validator->errors()->has('form.picture')){
                $this->form['picture'] = '';
            }
        })->validateOnly('form.picture');
    }


    public function getRules(){
        return [
            'form.title_ar'=>'required|max:500',
            'form.title_en'=>'required|max:500',
            'picture'=>'required|file|mimes:png,jpg,jpeg|max:10240'
        ];
    }
    public function render(){
        return view('livewire.admin.category.create')->layout('layouts.admin');
    }
}
