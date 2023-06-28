<?php

namespace App\Http\Livewire\Admin\Tasks;

use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\ValidationTrait;

class Edit extends Component{
    use WithFileUploads,ValidationTrait;
    public $form,$page_title,$mimes,$new_media_file,$new_media_file_rule;
    public $original_media_type;
    public $media_url,$current_media_type;

    public function mount(Task $task){
        $this->page_title = __('site.edit_instruction');
        $this->form = $task;
        $this->media_url = $task->media_url;
        $this->current_media_type=$task->media_type;
        $this->new_media_file_rule='nullable';
        $this->original_media_type = $this->form['media_type'];
    }

    public function updatedNewMediaFile(){
        $this->mimes = $this->form['media_type'] == 'video'? 'mp4' : 'png,jpg,jpeg';
        $this->validate([
            'form.media_type'=>'required|in:video,image|bail',
            'new_media_file'=>$this->new_media_file_rule.'|max:51200|mimes:'.$this->mimes
        ]);
        $this->current_media_type = $this->form['media_type'];
        $this->media_url = $this->new_media_file->temporaryUrl();
    }

    public function updatedFormMediaType(){
        $this->mimes = $this->form['media_type'] == 'video'? 'mp4' : 'png,jpg,jpeg';
        $this->new_media_file_rule=$this->form['media_type']==$this->original_media_type ? 'nullable' : 'required';
    }

    public function store(){
        $this->validate();
        if($this->new_media_file){
            $path = date('Y/m/d');
            $hashed_name = Str::random(50).'_'.mt_rand().'.'.$this->new_media_file->extension();
            $this->form['media_file'] = $this->new_media_file->storeAs($path,$hashed_name,'public');
        }

        $this->form->save();
        return redirect()->to(route('admin.task.index'));

    }

    public function getRules(){
        return [
            'form.title'=>'required|max:500',
            'form.description'=>'required|max:500',
            'form.content'=>'required|max:10000',
            'new_media_file'=>$this->new_media_file_rule.'|file|mimes:'.$this->mimes.'|max:51200',
            'form.media_type'=>'required|in:video,image',
        ];
    }

    public function getMessages(){
        return [
            'new_media_file.mimes'=>__('site.only_mimes_are_allowed') .': '. $this->mimes,
            'new_media_file.max'=>__('site.max_size_is_50_mb')
        ];

    }

    public function render(){
        return view('livewire.admin.tasks.edit');
    }
}
