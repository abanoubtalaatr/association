<?php

namespace App\Http\Livewire\Admin\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\ValidationTrait;

class Create extends Component
{
    use WithFileUploads, ValidationTrait;

    public $form, $page_title, $picture, $csvFile;

    public function mount()
    {
        $this->page_title = __('site.create_course');
    }

    public function store()
    {
        $this->validate();
        Course::create($this->form);
        session()->flash('success_message', __('site.created_successfully'));
        return redirect()->to(url('admin/courses'));
    }


    public function getRules()
    {
        return [
            'form.name' => 'required|max:500',
            'form.description' => 'required|max:500',
            'form.date' => 'required|date',
        ];
    }

    public function render()
    {
        return view('livewire.admin.course.create')->layout('layouts.admin');
    }
}
