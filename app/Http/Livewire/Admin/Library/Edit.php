<?php

namespace App\Http\Livewire\Admin\Library;

use App\Models\Library;

use Livewire\Component;

use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Livewire\Traits\ValidationTrait;

use Image;

class Edit extends Component{
    use ValidationTrait,WithFileUploads;
    public $media_files=[];
    public $all_media_files = [];
    public $page_title;
    public $form;
    public $categories;
    public $video_thumbnail;
    public $media_preview;




    public function mount(Library $library){
        $this->library = $library;
        $this->form = Arr::except($library->toArray(),['id','created_at','updated_at']);
        $this->page_title = __('site.edit_library');
        $this->categories = Category::orderBy('title_'.app()->getLocale())->get();
        $this->media_preview = url('uploads/pics/'.$this->form['media'][0]);
    }




    public function getWhatsappPreviewProperty(){
        return $this->video_thumbnail? $this->video_thumbnail->temporaryUrl() : url('uploads/pics/'.$this->form['video_thumbnail']);
    }

    public function store(){
        $this->validate();

        //(1): upload media
        $path = date('Y/m/d');
        $media = [];

        foreach($this->media_files as $single_media){

            $hashed_name = Str::random(25).'_'.mt_getrandmax().'.'.$single_media->extension();
            $new_media = $single_media->storeAs($path,$hashed_name,'public');
            if($single_media->extension()=='mp4'){

                $media = [$new_media];
                $this->form['media_type']='video';
                break;
            }
            $media[] = $new_media;
            $this->form['media_type']='image';
        }

        if($media){
            $this->form['media'] = $this->form['media_type']=='slider'? array_merge($media,$this->form['media']) : $media;
            $this->form['media_type'] = count($this->form['media'])>1? 'slider' : $this->form['media_type'];
        }




        //(2): Upload video thumbnail
        $hashed_name = $this->video_thumbnail? Str::random(25).'_'.mt_getrandmax().'.'.$this->video_thumbnail->extension() : '';
        if($this->video_thumbnail){
            ini_set('memory_limit', '256M');
            $this->form['video_thumbnail'] = $this->video_thumbnail->storeAs($path,$hashed_name,'public');
            $new_pic_path = Storage::disk('public')->path($this->form['video_thumbnail']);
            Image::make($new_pic_path)->resize(300,200)->save(Storage::disk('public')->path($path.'/thumb_'.$hashed_name));
        }


        //(3): create ad

        $this->library->update($this->form);

        session()->flash('success_message',__('site.saved'));
        return redirect()->to(route('admin.library'));
    }


    public function deletePic($pic_path){
        $this->form['media'] = array_filter($this->form['media'],function($el) use ($pic_path){
            return $el!=$pic_path;
        });
    }


    public function updatedFormWhatsappThumbnail(){
        $this->withValidator(function (Validator $validator) {
            if($validator->errors()->has('form.video_thumbnail')){
                $this->form['video_thumbnail'] = '';
            }
        })->validateOnly('form.video_thumbnail');
    }

    public function getRules(){
        $rules = [
            'form.category_id'=>'required',
            'form.title'=>'required|min:3|max:300',
            'form.description'=>'required|min:3|max:500',
            'form.short_description'=>'required|min:3|max:500',
            // 'form.link'=>'required|active_url|max:300',
            'video_thumbnail'=>'nullable|file|mimes:jpg,png,jpeg|max:300',

        ];

        $rules['form.media'] = 'nullable';

        return $rules;
    }


    public function updated(){
        $this->dispatchBrowserEvent('onContentChanged');
    }

    public function render(){
        $this->media_preview = $this->media_files? $this->media_files[0]->temporaryUrl() : url('uploads/pics/'.$this->form['media'][0]);
        $full_path_existing_media = array_map(function($element){
            return url('uploads/pics/'.$element);
        },$this->form['media']);

        $full_path_new_media = array_map(function($element){
            return $element->temporaryUrl();
        },$this->media_files);

        $this->all_media_files = array_merge($full_path_existing_media,$full_path_new_media);
        return view('livewire.admin.library.edit')->layout('layouts.admin');
    }
}
