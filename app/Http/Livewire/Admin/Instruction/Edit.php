<?php

namespace App\Http\Livewire\Admin\Instruction;

use App\Models\Category;
use App\Models\Instruction;
use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Validator;
use App\Http\Livewire\Traits\ValidationTrait;

class Edit extends Component{
    use WithFileUploads,ValidationTrait;

    public $form,$page_title,$picture,$instruction;
    public function mount(Instruction $instruction){
        $this->instruction = $instruction;
        $this->form = Arr::except($instruction->toArray(),['updated_at','created_at','id']);
        $this->page_title = __('site.edit_instruction');
    }

    public function store(){
        $this->validate();

        $this->instruction->update($this->form);
        session()->flash('success_message',__('site.saved_successfully'));
        return redirect()->to(url('admin/instructions'));
    }

    public function getRules(){
        return [
            'form.title_ar'=>'required|max:300',
            'form.title_en'=>'required|max:300',
            'form.description_ar'=> ['nullable'],
            'form.description_en'=> ['nullable'],
        ];
    }
    public function render(){
        return view('livewire.admin.instruction.create')->layout('layouts.admin');
    }
}
