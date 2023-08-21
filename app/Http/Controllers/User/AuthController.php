<?php

namespace App\Http\Controllers\User;

use App\Models\Setting;
use App\Models\User;
use App\Services\GenerateCodeService;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditProfileRequest;
use Illuminate\Support\Facades\Validator;
use function App\Helpers\sendMessageToWhatsApp;
use function App\Helpers\sendSms;


class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('front.auth.register');
    }

    public function showLoginForm()
    {
        return view('front.auth.login');
    }

    public function showForgotPasswordForm()
    {
        return view('front.auth.forgot_password');
    }


    public function verifyForgetPasswordCode(User $user)
    {
        return view('front.auth.verify_forget_password_code', compact('user'));
    }

    public function verifyRegisterCode()
    {
        return view('livewire.front.verify-account');
    }



    public function profile()
    {
        dd('fdslfkjds');
        return view('front.auth.profile');
    }

    public function saveProfile(EditProfileRequest $request)
    {
        $data = $request->validated();

        $data['avatar'] = $request->hasFile('avatar') ? $request->avatar->storeAs(date('Y/m/d'), Str::random(50) . '.' . $request->avatar->extension(), 'public') : auth('users')->user()->avatar;
        auth('users')->user()->update($data);
        return redirect()->to(route('user.edit_profile'))->withSuccessMessage(__('site.saved'));
    }

    public function logout(Request $request)
    {
        auth('users')->logout();
        return redirect()->to(route('user.login_form'));
    }
}
