<?php

namespace App\Http\Livewire\Admin\Library;

use App\Models\Library;

use Livewire\Component;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Livewire\Traits\ValidationTrait;
use Image;

class Create extends Component{
    use ValidationTrait,WithFileUploads;
    public $media_files=[];
    public $page_title;
    public $form;
    public $categories;
    public $video_thumbnail;
    public $media_preview;




    public function mount(){
        $this->form = [
            'media_type'=>'image',
            'video_thumbnail'=>'',
            'title'=>'',
            'description'=>'',
            'short_description'=>'',
            'link'=>'',
            'category_id'=>0
        ];
        $this->page_title = __('site.create_library');
        $this->categories = Category::orderBy('title_'.app()->getLocale())->get();
    }


    public function getWhatsappPreviewProperty(){
        return $this->video_thumbnail? $this->video_thumbnail->temporaryUrl() : asset('frontAssets').'/imgs/camp/ad-mac@2x.png';
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

        $this->form['media'] = $media;
        unset($media);

        $this->form['media_type'] = count($this->form['media'])>1? 'slider' : $this->form['media_type'];


        //(2): Upload & resize video thumbnail
        $hashed_name = Str::random(25).'_'.mt_getrandmax().'.'.$this->video_thumbnail->extension();


        ini_set('memory_limit', '256M');
        $this->form['video_thumbnail'] = $this->video_thumbnail->storeAs($path,$hashed_name,'public');
        $new_pic_path = Storage::disk('public')->path($this->form['video_thumbnail']);

        Image::make($new_pic_path)->resize(300,200)->save(Storage::disk('public')->path($path.'/thumb_'.$hashed_name));



        //(3): create ad

        $new_record = Library::create($this->form);

        session()->flash('success_message',__('site.saved'));
        return redirect()->to(route('admin.library'));
    }


    public function updated(){
        $this->dispatchBrowserEvent('onContentChanged');
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
            'form.category_id'=>'required|exists:categories,id',
            'form.title'=>'required|min:3|max:300',
            'form.description'=>'required|min:3|max:500',
            'form.short_description'=>'required|min:3|max:500',
            'media_files'=>'required|array',
            // 'form.link'=>'required|active_url|max:300',
            'video_thumbnail'=>'required|file|mimes:jpg,png,jpeg|max:300',

        ];

        $rules['form.media'] = 'nullable';

        return $rules;
    }





    public function render(){
        $this->media_preview = $this->media_files? $this->media_files[0]->temporaryUrl() : asset('frontAssets').'/imgs/camp/ad-mac@2x.png';
        return view('livewire.admin.library.create')->layout('layouts.admin');
    }
}
