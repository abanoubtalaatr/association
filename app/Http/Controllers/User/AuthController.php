<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditProfileRequest;


class AuthController extends Controller
{
    public function profile()
    {
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
