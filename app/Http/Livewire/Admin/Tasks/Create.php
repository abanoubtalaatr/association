<?php

namespace App\Http\Livewire\Admin\Tasks;

use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\ValidationTrait;

class Create extends Component{
    use WithFileUploads,ValidationTrait;
    public $form,$page_title,$mimes;

    public function mount(){
        $this->page_title = __('site.create_instruction');
        $this->form = [
            'media_file'=>null,
            'media_type'=>null
        ];
    }

    public function updatedFormMediaFile(){
        $this->mimes = $this->form['media_type'] == 'video'? 'mp4' : 'png,jpg,jpeg';
        $this->validate([
            'form.media_type'=>'required|in:video,image|bail',
            'form.media_file'=>'required|max:51200|mimes:'.$this->mimes
        ]);
    }

    public function updatedFormMediaType(){
        $this->mimes = $this->form['media_type'] == 'video'? 'mp4' : 'png,jpg,jpeg';
    }

    public function store(){
        $this->validate();
        $path = date('Y/m/d');
        $hashed_name = Str::random(50).'_'.mt_rand().'.'.$this->form['media_file']->extension();
        $this->form['media_file'] = $this->form['media_file']->storeAs($path,$hashed_name,'public');
        Task::create($this->form);
        return redirect()->to(route('admin.task.index'));

    }

    public function getRules(){
        return [
            'form.title'=>'required|max:500',
            'form.description'=>'required|max:500',
            'form.content'=>'required|max:10000',
            'form.media_file'=>'required|file|mimes:'.$this->mimes.'|max:51200',
            'form.media_type'=>'required|in:video,image',
        ];
    }

    public function getMessages(){
        return [
            'form.media_file.mimes'=>__('site.only_mimes_are_allowed') .': '. $this->mimes,
            'form.media_file.max'=>__('site.max_image_size_is_50_mb')
        ];

    }

    public function render(){
        return view('livewire.admin.tasks.create');
    }
}
