<?php

namespace App\Http\Controllers\Api;

use App\Services\FCMService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;

class ProfileController extends Controller{
    public function show(){
        return new UserResource(auth('api-users')->user());
    }

    public function update(EditProfileRequest $request){
        $data = $request->validated();
        unset($data['new_password']);
        $user = auth('api-users')->user();
        if($request->has('password')){
            abort_unless(Hash::check($request->password,$user->password),401,__('messages.error_password'));
        }

        $data['avatar'] =
            $request->avatar?
                $request->avatar->storeAs(date('Y/m/d'),Str::random(50).'.'.$request->avatar->extension(),'public'):
            $user->avatar;
        $data['password'] = $request->new_password? bcrypt($request->new_password) : $user->password;
        $user->update($data);
        return new UserResource(auth('api-users')->user());
    }

    public function updatePaymentMethod(UpdatePaymentMethodRequest $request){
        $user = auth('api-users')->user();
        $user->update($request->validated());

        $notifiable = $user;

        $title_ar = 'أدسولجرز';
        $title_en = 'Adsoldiers';

        $content_ar = sprintf('تم تحديث طريقة الدفع الخاصة بك');

        $content_en = sprintf('Your payment method has been updated');

        $title = ($notifiable->default_language=='ar')? $title_ar : $title_en;
        $body = ($notifiable->default_language=='ar')? $content_ar : $content_en;
        $type = 'soldier_update_payment_method';
        $subject_id = $user->id;


        FCMService::spark_send_fcm(
            $notifiable,
            $title,
            $body,
            compact('content_ar','content_en','title_ar','title_en','type','subject_id')
        );



        return new UserResource(auth('api-users')->user());
    }

    public function updatePassword(UpdatePasswordRequest $request){
        $current_user = auth('api-users')->user();
        abort_unless(Hash::check($request->current_password,$current_user->password),401,__('messages.error_password'));
        $current_user->update(['password'=>bcrypt($request->new_password)]);
        return response()->json(['message'=>__('messages.success_password')]);

    }

    public function delete(Request $request)
    {
        $current_user = auth('api-users')->user();
        $current_user->delete_requested_at = now();
        $current_user->save();
        return response()->json(['message'=>__('messages.success_password')]);

    }
}
