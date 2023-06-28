<?php

namespace App\Http\Livewire\Advertiser;

use App\Models\Camp;
use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\ValidationTrait;

class CampsEdit extends Component{
    use ValidationTrait;
    public $types,$page_title,$form;
    public Camp $camp;
    public function mount(Camp $camp){
        $this->page_title = __('site.edit_camp');
        $this->form = Arr::only($this->camp->toArray(),['title','type']);
        $this->types= [
            'awarness',
            'traffic',
            'app_installs',
            'video_views',
            'messages',
            'lead_generation'
        ];
    }


    public function update(){
        $this->validate();
        Camp::whereId($this->camp->id)->update($this->form);
        session()->flash('success_message',__('site.camp_edited_successfully'));
        return redirect()->to(route('user.camps'));
    }

    public function getRules(){
        return [
            'form.title'=>[
                'required',
                'max:200',
                Rule::unique('camps','title')->where('user_id',auth('users')->id())->ignore($this->camp->id)
            ],
            'form.type'=>'required|in:'.implode(',',$this->types)
        ];
    }
    public function render(){
        return view('livewire.advertiser.camps-edit');
    }
}
