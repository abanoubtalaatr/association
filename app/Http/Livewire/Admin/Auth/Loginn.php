<?php

namespace App\Http\Livewire\Admin\Auth;

use Kreait\Firebase\Auth;
use Livewire\Component;

class Loginn extends Component
{
    public $email, $password, $error_message = '';

    public function mount()
    {
        $this->error_message = '';
    }

    public function attempt()
    {
        $this->validate();
        if (auth('admin')->attempt(['email' => $this->email, 'password' => $this->password])) {
            if (auth('admin')->user()->is_active == 0) {
                auth('admin')->logout();
                session()->flash('in_active_message', trans('site.your_account_not_active'));
                return redirect()->to(route('admin.login_form'));
            }
            return redirect()->to(route('admin.dashboard'));
        } else {
            $this->error_message = __('messages.Wrong_credential');
        }
    }


    public function getRules()
    {
        return [
            'password' => 'required|min:8',
            'email' => 'required|max:200|email'
        ];
    }

    public function render()
    {
        return view('livewire.admin.login');
    }
}
