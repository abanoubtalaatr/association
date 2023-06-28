<?php

namespace App\Http\Livewire\Advertiser;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\ValidationTrait;

class CampsCreate extends Component{
    use ValidationTrait;
    public $types,$page_title,$form;
    public function mount(){
        $this->page_title = __('site.create_camp');
        $this->form = ['status'=>'active'];
        $this->types= [
            'awarness',
            'traffic',
            'app_installs',
            'video_views',
            'messages',
            'lead_generation'
        ];
    }


    public function store(){
        $this->validate();
        auth('users')->user()->camps()->create($this->form);
        session()->flash('success_message',__('site.camp_created_successfully'));
        return redirect()->to(route('user.camps'));
    }

    public function getRules(){
        return [
            'form.title'=>[
                'required',
                'max:200',
                Rule::unique('camps','title')->where('user_id',auth('users')->id())
            ],
            'form.type'=>'required|in:'.implode(',',$this->types)
        ];
    }
    public function render(){
        return view('livewire.advertiser.camps-create');
    }
}
