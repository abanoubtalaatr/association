<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $passport, $last_name, $remember_me, $error_message = '';

    public function login(Request $request)
    {
        $this->validate();
        $credentials = ['password' => $this->passport, 'last_name' => $this->last_name];

        $user = User::wherePassport($this->passport)->whereLastName($this->last_name)->first();
        if ($user)

            if (auth('users')->attempt(['password' => '123456789', 'passport' => $this->passport])) {
                return redirect()->to(route('user.dashboard'));
            }


//        if (auth('users')->attempt(['username' => $this->username, 'password' => $this->password], $this->remember_me)) {
//            if (auth()->user()->is_verified == 0 && auth()->user()->user_type == 'soldier') {
//                return redirect()->to(route('user.verify_register_code'));
//            }
//            $user = auth('api-users')->user();
//
//            return redirect()->to(route('user.dashboard'));
//        } else {
        if (\auth('users')->attempt(['passport' => $this->passport, 'last_name' => $this->last_name, 'password' => ''], $this->remember_me)) {
            if (auth()->user()->is_verified == 0 && auth()->user()->user_type == 'soldier') {
                return redirect()->to(route('user.verify_register_code'));
            }
        }else {
            $this->error_message = __('not_valid_credentials');
        }
        dd('an error');
        return redirect()->to(route('user.dashboard'));
//            } else {
//
//                if (auth('users')->attempt(['email' => $this->username, 'password' => $this->password], $this->remember_me)) {
//                    if (auth()->user()->is_verified == 0 && auth()->user()->user_type == 'soldier') {
//                        return redirect()->to(route('user.verify_register_code'));
//                    }
//                    return redirect()->to(route('user.dashboard'));
//                }
//                $this->error_message = __('messages.Wrong_credential');
//            }
//
//        }
    }

    public function getRules()
    {
        return [
            'last_name' => 'required|exists:users,last_name',
            'passport' => 'required|exists:users,passport'
        ];
    }

    public function render()
    {
        return view('livewire.user.login');
    }
}
