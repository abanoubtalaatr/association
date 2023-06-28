<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Customer;
use App\Models\UserDevice;
use Illuminate\Support\Str;
use App\Services\OTPService;
use Illuminate\Http\Request;
use App\Models\CustomerDevice;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Services\GenerateCodeService;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\RegisterUserRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\VerifyAccountRequest;
use App\Http\Requests\SaveResetPasswordRequest;
use App\Http\Requests\RequestResetPasswordRequest;
use App\Http\Requests\VerifyResetPasswordCodeRequest;
use App\Http\Requests\VerifyForgetPasswordCodeRequest;
use App\Http\Requests\Customer\LoginCustomerFormRequest;
use App\Http\Requests\Customer\RegisterCustomerFormRequest;
use Illuminate\Support\Facades\Http;
use function App\Helpers\sendMessageToWhatsApp;

class AuthController extends Controller
{
    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function register(RegisterUserRequest $request)
    {
        $inputs = $request->validated();
        unset($inputs['password_confirmation'], $inputs['terms_accepted']);
        $password = $inputs['password'];
        $inputs['password'] = bcrypt($inputs['password']);

        $inputs['avatar'] = request('avatar') ? $request->avatar->storeAs(date('Y/m/d'), Str::random(50) . '.' . $request->extension(), 'uploads') : null;
        $user = new User($inputs);


        if ($user->save()) {
            try {
                $token = auth('api-users')->attempt(['username' => $user->username, 'password' => $password]);
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }
            //Mail::to($driver->email)->send(new EmailVerificationMail($driver));
//            $code = GenerateCodeService::getCode();
//            if ($request->mobile) {
////                $url = "https://REST.GATEWAY.SA/api/SendSMS?api_id=API33785225719&api_password=wbH2RR2S7pPJFKF&sms_type=T&encoding=T&sender_id=Adsoldiers&phonenumber=" . $request->mobile . "&textmessage=Your Code" . $code . "&uid=xyz&callback_url=https://xyz.com";
////                $response = Http::get($url);
////                $response = json_decode($response->getBody()->getContents(), true);
////                if ($response['status'] == 'F') {
////                    return response()->json(['message' => 'Something went Wrong In sending message', 400]);
////                } else {
//                OTPService::generateCode('verification', $user->id, $code);
//                info('the code' . $code);
//
////                }
//            }
            info('inside register');
            return response()->json([
                'token' => $token,
                'user' => UserResource::make($user)

            ]);
        }
        return response()->json(['message' => 'Something went Wrong', 400]);
    }


    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();
        $guard = auth('api-users');

        if ($token = $guard->attempt($credentials)) {

        } else {
            if ($token = $guard->attempt(['mobile' => $request->username, 'password' => $request->password])) {

            } else {
                if ($token = $guard->attempt(['email' => $request->username, 'password' => $request->password])) {

                } else {
                    return response()->json(['message' => __('general.invalidLoginData')], 401);
                }
            }
        }


        $user = auth('api-users')->user();
        //is_verified
        abort_if($user->delete_requested_at, 403, __('general.invalidLoginData'));

        UserDevice::whereUserId($user->id)->delete();
        UserDevice::firstOrCreate(['user_id' => $user->id, 'device_token' => $request->device_token, 'type' => $request->type]);

        abort_unless($user->is_active, 401, __('general.your_account_is_pending'));
        abort_unless($user->is_verified == 0, 401, __('general.your_account_not_verified'));

        // $token = !is_bool($token1)? $token1 : (!is_bool($token2)? $token2 : $token3);
        return ['token' => $token, 'user' => new UserResource($user)];
    }


    public function logout(Request $request)
    {
        auth('api-users')->logout();
        $device = UserDevice::
        where(['user_id' => auth('api-users')->id(), 'device_token' => $request->device_token, 'type' => $request->type])
            ->first();
        $device != null ? $device->delete() : "";
        return response()->json(['message' => __('general.logged_out_sucessfully')]);
    }


    public function sendResetPasswordCode(RequestResetPasswordRequest $request)
    {
        $customer = Customer::where('mobile', request('mobile'))->first();
        abort_unless($customer, 400, __('site.wrong_account'));
        abort_if($customer->status == 'inactive', 400, __('general.your_account_is_pending'));

        $wait_for = $customer->reset_password_code_generated_at ? $customer->reset_password_code_generated_at->addHours(1)->diffInSeconds(now()) : 0;

        if ($customer->reset_password_num > 2 && $wait_for > 0) {
            return response()->json([
                'message' => __('site.sms_is_temp_disabled'),
                'wait_for' => $wait_for
            ], 400);
        }

        $code = GenerateCodeService::getCode();
        $customer->update([
            'reset_password_code' => $code,
            'reset_password_num' => ($customer->reset_password_num + 1) % 4,
            'reset_password_code_generated_at' => now()
        ]);
        if ($request->mobile) {
            $url = "https://REST.GATEWAY.SA/api/SendSMS?api_id=API33785225719&api_password=wbH2RR2S7pPJFKF&sms_type=T&encoding=T&sender_id=Adsoldiers&phonenumber=" . $request->mobile . "&textmessage=Your Code: " . $code . "&uid=xyz&callback_url=https://xyz.com";
            $response = Http::get($url);
            $response = json_decode($response->getBody()->getContents(), true);
            if ($response['status'] == 'F') {
                return response()->json(['message' => 'Something went Wrong In sending message', 400]);
            }
        }

        return response()->json([
            'code' => $code,
            'message' => __('general.password_reset_email_was_sent'),
            'wait_for' => $customer->reset_password_code_generated_at->addMinutes(1)->diffInSeconds(now())
        ]);
    }


    public function verifyForgetPasswordCode(VerifyForgetPasswordCodeRequest $request)
    {
        $user = Customer::where('mobile', request('mobile'))->first();

        if ($user) {
            if ($user->reset_password_code == request('code')) {
                return response()->json(['status' => true, 'message' => __('site.correct_code')]);
            }
            return response()->json(['status' => false, 'message' => __('site.invalid_code')], 422);
        }
        return response()->json(['status' => false, 'message' => __('site.wrong_account')], 400);
    }


    public function getResetPasswordCode(Request $request)
    {
        $username = $request->username;

        if (!$user_id = optional(User::whereUsername($username)->first())->id) {
            if (!$user_id = optional(User::whereMobile($username)->first())->id) {
                if (!$user_id = optional(User::whereEmail($username)->first())->id) {
                    return response()->json(['message' => __('site.incorrect_data')], 404);
                }
            }
        }

        $code = GenerateCodeService::getCode();
        $user = User::find($user_id);
        if ($user->mobile) {
            $url = "https://REST.GATEWAY.SA/api/SendSMS?api_id=API33785225719&api_password=wbH2RR2S7pPJFKF&sms_type=T&encoding=T&sender_id=Adsoldiers&phonenumber=" . $user->mobile . "&textmessage=Your Code" . $code . "&uid=xyz&callback_url=https://xyz.com";
            $response = Http::get($url);
            $response = json_decode($response->getBody()->getContents(), true);
            if ($response['status'] == 'F') {
                return response()->json(['message' => 'Something went Wrong In sending message', 400]);
            }
        }
        info('the code from reset the code' . $code);
        return OTPService::generateCode('reset_password', $user_id, $code);
    }


    public function verifyResetPasswordCode(VerifyResetPasswordCodeRequest $request)
    {
        $redis_code = Redis::get('reset_password_code_value.' . $request->user_id);
        abort_if($request->code != $redis_code, 400, __('site.code_is_worng'));
        $secret_code = Str::random(100);
        Redis::set('reset_password_secret.' . $request->user_id, $secret_code, 'EX', 3600);
        return response()->json(['message' => __('site.correct_code'), 'secret_code' => $secret_code]);
    }

    public function saveResetPassword(SaveResetPasswordRequest $request)
    {
        abort_unless($request->secret_code == Redis::get('reset_password_secret.' . $request->user_id), 400, __('site.not_allowed'));
        $user = User::find($request->user_id);
        $user->update(['password' => bcrypt($request->new_password)]);
        return response()->json(['message' => __('general.saved'), 'data' => new UserResource($user)]);
    }/**/

    public function getVerificationCode(Request $request)
    {
        info("insert intos get veification route");
        $code = GenerateCodeService::getCode();
        $url = "https://REST.GATEWAY.SA/api/SendSMS?api_id=API33785225719&api_password=wbH2RR2S7pPJFKF&sms_type=T&encoding=T&sender_id=Adsoldiers&phonenumber=" . auth('api-users')->user()->mobile . "&textmessage=Your Code" . $code . "&uid=xyz&callback_url=https://xyz.com";
        $response = Http::get($url);
        $response = json_decode($response->getBody()->getContents(), true);
        if ($response['status'] == 'F') {
            return response()->json(['message' => 'Something went Wrong In sending message', 400]);
        } else {
            info('the code' . $code);
            return OTPService::generateCode('verification', auth('api-users')->id(), $code);

        }
//        return OTPService::generateCode('verification', auth('api-users')->id(), $code);
    }

    public function verify(VerifyAccountRequest $request)
    {
        $redis_code = Redis::get('verification_code_value.' . auth('api-users')->id());
        info('redis code in when register and verify ' . $redis_code);
        abort_if($request->code != $redis_code, 400, __('site.verification_code_is_wrong'));
        auth('api-users')->user()->update(['is_verified' => 1, 'is_active' => 1]);
        $settings = Setting::first();

        $message = $settings->solider_whats_app_message;
        $file =null;

        if(!is_null($settings->solider_whats_app_file)){
            $file = url('uploads/pics/' . $settings->solider_whats_app_file);
        }

        sendMessageToWhatsApp(auth('api-users')->user()->mobile, $message, $file);

        return new UserResource(auth('api-users')->user());
    }

    public function destroy()
    {
        auth('api-users')->user()->update(['delete_requested_at' => now()]);
        auth('api-users')->logout();
        return response()->json(['message' => __('site.your_account_has_been_deleted')]);
    }
}
