<?php

use App\Models\Ad;
use App\Models\Library;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AdsFilterService;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{AdController,
    AuthController,
    CampController,
    DataController,
    PageController,
    TaskController,
    SliderController,
    WalletController
};
use App\Http\Controllers\Api\{BillingController,
    ContactController,
    ProfileController,
    CategoryController,
    LanguageController,
    TransactionController,
    NotificationController
};

Route::group(['middleware' => 'acceptLocale'], function () {

    Route::get('test-ad-soldiers/{ad_id}', function ($ad_id) {
        return AdsFilterService::getAdSoldiersQuery($ad_id)->get();
    });

    Route::get('instructions', \App\Http\Controllers\Api\InstructionController::class)
        ->name('instructions');

    Route::get('slider', SliderController::class);
    Route::get('pages/{page}', [PageController::class, 'show']);
    Route::get('countries', [DataController::class, 'getCountries']);
    Route::get('ages', [DataController::class, 'getAges']);
    Route::get('audiences', [DataController::class, 'getAudience']);
    Route::get('languages', [DataController::class, 'getLanguages']);
    Route::get('genders', [DataController::class, 'getGenders']);

    Route::get('country/{country}/cities', [DataController::class, 'getCountryCities']);
    Route::get('contact-settings', [DataController::class, 'contactSettings']);
    Route::get('settings', [DataController::class, 'contactSettings']);

    Route::post('contact-us', [ContactController::class, 'store']);

    Route::get('ages', [DataController::class, 'getAges']);
    Route::get('audience', [DataController::class, 'getAudience']);

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);


    Route::get('get-reset-password-code', [AuthController::class, 'getResetPasswordCode']);
    Route::post('verify-reset-password-code', [AuthController::class, 'verifyResetPasswordCode']);
    Route::post('save-reset-password', [AuthController::class, 'saveResetPassword']);


    Route::delete('delete-account', [AuthController::class, 'destroy'])->middleware(['auth:api-users']);
    Route::group(['middleware' => ['auth:api-users', 'logoutInactiveUser'], 'prefix' => 'user'], function () {


        Route::get('get-verification-code', [AuthController::class, 'getVerificationCode']);
        Route::post('verify', [AuthController::class, 'verify']);


        Route::get('notifications', [NotificationController::class, 'index']);
        Route::post('notifications/{notification}/read', [NotificationController::class, 'update']);

        Route::get('transactions', TransactionController::class);
        Route::get('profile', [ProfileController::class, 'show']);
        Route::post('profile', [ProfileController::class, 'update']);
        Route::get('delete-account', [ProfileController::class, 'delete']);
        Route::post('update-payment-method', [ProfileController::class, 'updatePaymentMethod']);
        Route::post('update-password', [ProfileController::class, 'updatePassword']);


        Route::get('tasks/{task}', [TaskController::class, 'show']);
        Route::post('tasks/{task}/complete', [TaskController::class, 'update']);
        Route::get('tasks', [TaskController::class, 'index']);

        Route::get('ads/{ad}', [AdController::class, 'show']);

        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('category/{category}', [CategoryController::class, 'show']);
        Route::get('category/{category}/libraries', [CategoryController::class, 'libraries']);
        Route::get('library/{library}', [CategoryController::class, 'getLibrary']);

        Route::post('language', [LanguageController::class, 'update']);
        Route::get('refresh-token', function () {
            $token = JWTAuth::getToken();
            return response()->json(['token' => JWTAuth::refresh($token)]);
        });

        Route::post('logout', [AuthController::class, 'logout'])->middleware('jwt.auth');
        Route::get('ads', [AdController::class, 'index']);
        //Route::post('change-password',[ProfileController::class,'changePassword']);

        Route::get('wallet', [WalletController::class, 'index']);

        Route::group(['as' => 'advertiser'], function () {
            Route::get('stats', [AdController::class, 'advertiserStats']);
            Route::get('ad/{ad}/stats', [AdController::class, 'stats']);

            Route::get('camps', [CampController::class, 'index']);
            Route::get('camps/types', [CampController::class, 'campTypes']);
            Route::post('camps', [CampController::class, 'store']);
            Route::post('camps/{camp}', [CampController::class, 'update']);
            Route::post('camps/{camp}/deactivate', [CampController::class, 'deactivate']);

            Route::post('ads', [AdController::class, 'store']);
            Route::post('ads/{ad}', [AdController::class, 'update']);
            Route::post('ads/{ad}/toggleStatus', [AdController::class, 'toggleStatus']);
            Route::post('upload-media', [AdController::class, 'uploadMedia']);
            Route::get('billing', [BillingController::class, 'index']);

            Route::get('ads/{ad}/statistics', [AdController::class, 'stats']);

        });
        /** Advertiser endpoints*/


    });
    /**authenticated users: soldier, advertiser */


});
