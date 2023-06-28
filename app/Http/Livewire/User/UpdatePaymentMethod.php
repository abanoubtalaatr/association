<?php

namespace App\Http\Livewire\User;

use App\Http\Livewire\Traits\ValidationTrait;
use Livewire\Component;

class UpdatePaymentMethod extends Component{
    use ValidationTrait;
    public $payment_methods,$success_message;
    public $payment_method,$payment_number;
    public function mount(){
        $this->payment_methods = ['stc','paypal'];
        $this->payment_method=auth('users')->user()->payment_method;
        $this->payment_number = auth('users')->user()->payment_number;
    }


    public function store(){
        $this->validate();
        auth('users')->user()->update([
            'payment_method'=>$this->payment_method,
            'payment_number'=>$this->payment_number
        ]);
        $this->dispatchBrowserEvent('saved',['message'=>__('site.saved')]);
    }

    public function getRules(){
        $rules = [
            'payment_method'=>'required|in:paypal,stc'
        ];
        if($this->payment_method=='paypal'){
            $rules['payment_number'] = 'required|email:dns,rfc|max:200';
        }else{
            $rules['payment_number'] = 'required|integer|digits:9';
        }
        return $rules;
    }

    public function render(){
        return view('livewire.user.update-payment-method');
    }
}
