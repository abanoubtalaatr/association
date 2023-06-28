<?php

namespace App\Http\Livewire\Admin\Instruction;

use App\Models\Instruction;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\ValidationTrait;

class Create extends Component{
    use WithFileUploads,ValidationTrait;

    public $form,$page_title,$picture;
    public function mount(){
        $this->page_title = __('site.create_instruction');
    }

    public function store(){
        $this->validate();
        Instruction::create($this->form);
        session()->flash('success_message',__('site.created_successfully'));
        return redirect()->to(url('admin/instructions'));
    }


    public function getRules(){
        return [
            'form.title_ar'=>'required|max:500',
            'form.title_en'=>'required|max:500',
            'form.description_ar'=> ['nullable'],
            'form.description_en'=> ['nullable'],
        ];
    }

    public function render(){
        return view('livewire.admin.instruction.create')->layout('layouts.admin');
    }
}
