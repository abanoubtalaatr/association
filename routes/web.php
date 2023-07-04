<?php

use App\Models\Ad;
use App\Models\AdDevices;
use App\Models\AdTime;
use App\Models\AdUser;
use App\Models\Discount;
use App\Models\Library;
use App\Models\Setting;
use App\Models\User;

use App\Models\Filter;

use App\Models\AdProfit;


use App\Notifications\AdFinishedNotification;
use App\Services\GoogleAnalyticsService;
use App\Services\OTPService;
use Illuminate\Http\Request;
use App\Services\HyperpayService;

use App\Services\AdsFilterService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Front\ContactUs;


use App\Http\Livewire\User\EditProfile;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibraryController;
use App\Http\Livewire\Front\ForgotPassword;

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\MyFatoorahController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Advertiser\CampController;


use App\Http\Livewire\Admin\Pages\Edit as PagesEdit;

use App\Http\Controllers\Advertiser\BillingController;
use App\Http\Livewire\Admin\Pages\Index as PagesIndex;
use App\Http\Livewire\Admin\Settings as SettingsIndex;
use App\Http\Livewire\Admin\Slider\Edit as SliderEdit;
use App\Http\Livewire\Admin\Library\Edit as LibraryEdit;
use App\Http\Livewire\Admin\Pages\Create as PagesCreate;
use App\Http\Livewire\Admin\Pages\Delete as PagesDelete;
use App\Http\Livewire\Admin\Partner\Edit as PartnerEdit;
use App\Http\Livewire\Admin\Slider\Index as SliderIndex;
use App\Http\Livewire\Admin\Category\Edit as CategoryEdit;
use App\Http\Livewire\Admin\Library\Index as LibraryIndex;
use App\Http\Livewire\Admin\Partner\Index as PartnerIndex;
use App\Http\Livewire\Admin\Slider\Create as SliderCreate;
use App\Http\Livewire\Admin\Slider\Delete as SliderDelete;
use App\Http\Livewire\Admin\Discount\Create as DiscountCrate;
use App\Http\Livewire\Admin\Discount\Delete as DiscountDelete;
use App\Http\Livewire\Admin\Discount\Edit as DiscountEdit;
use App\Http\Livewire\Admin\Discount\Index as DiscountIndex;
use App\Http\Livewire\Admin\Role\Index as RoleIndex;
use App\Http\Livewire\Admin\Role\Edit as RoleEdit;
use App\Http\Livewire\Admin\Role\Create as RoleCreate;
use App\Http\Livewire\Admin\Role\Delete as RoleDelete;
use App\Http\Livewire\Admin\Admins\Index as AdminIndex;
use App\Http\Livewire\Admin\Admins\Edit as AdminEdit;
use App\Http\Livewire\Admin\Admins\Create as AdminCreate;

use App\Http\Livewire\User\Library\Show as UserShowLibrary;
use App\Http\Livewire\Admin\Category\Index as CategoryIndex;
use App\Http\Livewire\Admin\Library\Create as LibraryCreate;
use App\Http\Livewire\Admin\Library\Delete as LibraryDelete;
use App\Http\Livewire\Admin\Partner\Create as PartnerCreate;


use App\Http\Livewire\Admin\Partner\Delete as PartnerDelete;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use App\Http\Livewire\User\Library\Index as UserLibraryIndex;
use App\Http\Livewire\Admin\Category\Create as CategoryCreate;
use App\Http\Controllers\User\AdController as UserAdController;
use App\Http\Livewire\User\Category\Index as UserCategoryIndex;
use App\Http\Livewire\User\PaybackRequests\Index as WalletIndex;
use App\Http\Controllers\User\TaskController as UserTaskController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\TaskController as AdminTaskController;
use App\Http\Livewire\Admin\PaybackRequest\Pay as PaybackRequestsPay;
use App\Http\Controllers\User\ContactController as UserContactController;
use App\Http\Livewire\Admin\PaybackRequest\Index as PaybackRequestsIndex;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use Spatie\Analytics\Analytics;
use Spatie\Analytics\Period;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

Route::get('test', function () {

    //get user profit from library then check if less than the max of amount that can get from library

//    $soldier_current_profit = AdProfit::whereSoldierId(40)->whereAdId(47)->sum('amount');
//    dd($soldier_current_profit);
});

Route::get('ads/{ad}/fatorah_pay', [MyFatoorahController::class, 'pay'])->name('pay_fatorah');


Route::get('master', function () {
    dd('master');
});

Route::get('adham', function (){
   dd('Mr.adham');

});
Route::get('abanoub', function () {
    $key = Str::random(60);
    // Make sure the key is unique

    // Update the JWT_SECRET in the .env file
    file_put_contents(base_path('.env'), str_replace(
        'JWT_SECRET=' . \Illuminate\Support\Facades\Config::get('jwt.secret'),
        'JWT_SECRET=' . $key,
        file_get_contents(base_path('.env'))
    ));
    // Update the JWT_SECRET in the configuration
    \Illuminate\Support\Facades\Config::set('jwt.secret', $key);
    return $key;
});

Route::get('my_fatoorah_view', function () {
    return view('payment.my_fatorah');
});


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {

    Route::get('ads/sucess/{ad}', function (Request $request, $id) {
        $paid_ad = Ad::where('id', $id)->first();
        if (!$paid_ad) {
            return;
        }

        if ($paid_ad->update(['payment_id' => $request['id'], 'remaining_budget' => $paid_ad->budget, 'status' => 'reviewing', 'payment_info' => $request->all()])) {
            return redirect()->to(route('user.show_ad', $paid_ad->id) . '?status=ad-payment-completed');
        }

        return 'success payment';
    });

    Route::get('ads/fail', function (Request $request) {
        return ' fail, Please try again';
    })->name('payment.error');

    Route::get('/', [HomeController::class, 'index'])->name('homepage');
    Route::get('contact-us', ContactUs::class)->name('contact_us');
    Route::get('page/{page}', [HomeController::class, 'showPage'])->name('show_page');


//    Route::get('short-link/{shortLink}', [ShortLinkController::class, 'show'])->name('short_link.show');
    Route::get('ad/{ad}/{utm?}', [LibraryController::class, 'showAd'])->name('show_ad');
    Route::get('library/{library}/{utm?}', [LibraryController::class, 'show'])->name('show_library');

//    Route::get('ad/{ad}/{utm?}/visit-ad', [LibraryController::class, 'showAd'])->name('show_ad');
//    Route::get('library/{library}/{utm?}/visit-library', [LibraryController::class, 'show'])->name('show_library');

    Route::post('/ad/{ad}/increase-clicks', [LibraryController::class, 'increaseClicks'])->name('increase_clicks_of_ad');

    Route::group(['as' => 'user.', 'prefix' => 'user/'], function () {
        Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register_form');
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login_form')
            ->middleware('checkUserIsLogin');
        Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');
        Route::get('verify-forget-password-code/{user}', [AuthController::class, 'verifyForgetPasswordCode'])->name('verify_forget_password_code');
        Route::get('verify-register-code', [AuthController::class, 'verifyRegisterCode'])->name('verify_register_code');
        Route::post('verify-register-code', [AuthController::class, 'verifyRegisterCodePost'])->name('verify_registration_code');
        Route::post('send-verify-code', [AuthController::class, 'resendOtpCode'])->name('resend_verification_code');
        /**Confirm payment */
        Route::get('payment/status/web', function (Request $request) {
            $payment_service = new HyperpayService;
            $response = $payment_service->getPaymentStatus(request('id'));
            $paid_ad = Ad::where('checkout_id', $response['ndc'])->first();
            if ($response['result']['code'] != '000.100.112') {
                return redirect()->to(route('user.show_ad', $paid_ad->id) . '?status=ad-payment-failed');
                return $response['result']['description'] . ' - ' . $response['result']['code'];
            }

            if (!$paid_ad) {
                return;
            }

            if ($paid_ad->update(['payment_id' => $response['id'], 'remaining_budget' => $paid_ad->budget, 'status' => 'reviewing', 'payment_info' => $response])) {
                return redirect()->to(route('user.show_ad', $paid_ad->id) . '?status=ad-payment-completed');
            }

        })->name('confirm_pay_ad');
        /**Confirm payment */

        Route::get('success_payment', function () {
            return 'success';
        })->name('success_pay');

        Route::get('ads/{ad}/pay', [UserAdController::class, 'pay'])->name('pay_ad');

        Route::get('ads/{ad}/fatorah_pay', [MyFatoorahController::class, 'pay'])->name('pay_fatorah');
        Route::get('ads/sucess/{ad}', function (Request $request, $id) {
            $paid_ad = Ad::where('id', $id)->first();
            $status = new \App\Http\Controllers\MyfatoorahCheckPaymentStatusController();
            $status = $status->checkStatus($request->paymentId);

            // حاليا كود الفحص شغال ناقص بس تحط الكود جوا الل ايف دي
            if ($status == 'Paid') {


            }
            // I want to ensure that the payment is successfully happened
            //how to ensure
            if (!$paid_ad) {
                return;
            }

            if ($paid_ad->update([
                'payment_id' => $request['id'],
                'remaining_budget' => $paid_ad->budget,
                'discount_info_ar' => session()->get('discount_info_ar') ?? null,
                'discount_info_en' => session()->get('discount_info_en') ?? null,
                'status' => 'reviewing',
                'payment_info' => $request->all()
            ])) {
                if (session()->has('user_discount')) {
                    $discount = Discount::where('discount_code', session()->get('discount_code'))->first();
                    if ($discount) {
                        $discount->update([
                            'number_of_times' => $discount->number_of_times -= 1,
                            'number_of_times_is_used' => $discount->number_of_times_is_used += 1,
                        ]);
                    }
                }
                return redirect()->to(route('user.show_ad', $paid_ad->id) . '?status=ad-payment-completed');
            }

            return 'success payment';
        })->name('fatorah_sucess');

        Route::get('ads/fail/{id}', function (Request $request, $id) {
            $paid_ad = Ad::where('id', $id)->first();
            return redirect()->to(route('user.show_ad', $paid_ad->id) . '?status=ad-payment-failed');
        })->name('fatorah_error');

        Route::group(['middleware' => 'auth'], function () {
            Route::get('notifications', [NotificationController::class, 'userNotification'])->name('notifications.index');
            Route::get('logout', [AuthController::class, 'logout'])->name('logout');

            Route::get('profile', [AuthController::class, 'profile'])->name('edit_profile');
            Route::post('save-profile', [AuthController::class, 'saveProfile'])->name('save_profile');

            Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
            Route::get('billing', [BillingController::class, 'index'])->name('billing');
            Route::get('camps', [CampController::class, 'index'])->name('camps');
            Route::get('camps/create', [CampController::class, 'create'])->name('create_camp');
            Route::get('camps/{camp}/edit', [CampController::class, 'edit'])->name('edit_camp');
            Route::get('tasks', [UserTaskController::class, 'index'])->name('tasks');
            Route::get('tasks/{task}', [UserTaskController::class, 'show'])->name('show_task');
            Route::get('tasks/{task}/complete', [UserTaskController::class, 'userComplete'])->name('complete_task');

            Route::get('ads', [UserAdController::class, 'index'])->name('ads');
            Route::get('ads/create', [UserAdController::class, 'create'])->name('create_ad');
            Route::get('ads/{ad}/edit', [UserAdController::class, 'edit'])->name('edit_ad');
            Route::get('ads/{ad}/show', [UserAdController::class, 'show'])->name('show_ad');
            Route::get('ads/{ad}/stats', [UserAdController::class, 'stats'])->name('ad_stats');


            Route::get('category/{category}/libraries', UserLibraryIndex::class)->name('library');
            Route::get('category', UserCategoryIndex::class)->name('category');
            Route::get('library/{library}', UserShowLibrary::class)->name('library.show');

            Route::get('wallet', WalletIndex::class)->name('wallet');

            Route::get('contact', [UserContactController::class, 'index'])->name('contact_us');

        });/*authenticated users*/

    });


    //Admin
    Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {

        Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login_form')->middleware('checkAdminIsLogin');

        Route::group(['middleware' => 'auth:admin'], function () {

            // admins
            Route::get('admins', AdminIndex::class)->name('admins.index');
            Route::get('admins/{admin}/edit', AdminEdit::class)->name('admins.edit');
            Route::get('/admins/create', AdminCreate::class)->name('admins.create');

            Route::get('billing', \App\Http\Livewire\Admin\Billing\Index::class)->name('billing.index');
            Route::get('users', \App\Http\Livewire\Admin\Users\Index::class)->name('users.index');
            Route::get('users/{user}/stats', \App\Http\Livewire\Admin\Users\Stats::class)->name('user_stats');
            Route::get('users/{user}/user_library_stats', \App\Http\Livewire\Admin\Users\LibraryStats::class)->name('user_library_stats');
            Route::get('users/{user}/ad/{ad}/stats', \App\Http\Livewire\Admin\Users\UserAdStats::class)->name('user_ad_stats');
            Route::get('users/{user}/ads/stats', \App\Http\Livewire\Admin\Users\UserAdsStats::class)->name('user_ads_stats');

            Route::get('users/{user}/library', \App\Http\Livewire\Admin\Users\UserLibraryStats::class)->name('user_single_library_stats');


            Route::get('ads/{ad}/stats', [UserAdController::class, 'adminStats'])->name('ad_stats');
            Route::get('ads/{ad}/soldiers', [UserAdController::class, 'adminAdSoldiers'])->name('ad_soldiers');
            Route::get('users/{user}/edit', \App\Http\Livewire\Admin\Users\Edit::class)->name('users.edit');


            Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');
            Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

            Route::get('ads', \App\Http\Livewire\Admin\Ads\Index::class)->name('ads');
            Route::get('ads/{ad}', \App\Http\Livewire\Admin\Ads\Show::class)->name('show_ad');
            Route::get('ads/{ad}/edit', [UserAdController::class, 'editStatus'])->name('ads.edit');
            Route::post('ads/{ad}/update', [UserAdController::class, 'saveEditStatus'])->name('ads.update');

            Route::resource('task', AdminTaskController::class);
            Route::get('contact', [AdminContactController::class, 'index'])->name('contact_us');
            Route::get('contact/{contact}', [AdminContactController::class, 'show'])->name('contact.show');
            Route::put('contact/{contact}', [AdminContactController::class, 'update'])->name('contact.update');

            Route::get('slider/index', SliderIndex::class)->name('slider');
            Route::get('slider/create', SliderCreate::class)->name('create_slider');
            Route::get('slider/{slider}/edit', SliderEdit::class)->name('edit_slider');
            Route::get('slider/{slider}/delete', SliderDelete::class)->name('delete_slider');

            Route::get('discount/index', DiscountIndex::class)->name('discount');
            Route::get('discount/create', DiscountCrate::class)->name('create_discount');
            Route::get('discount/{discount}/edit', DiscountEdit::class)->name('edit_discount');
            Route::get('discount/{discount}/delete', DiscountDelete::class)->name('delete_discount');


            Route::get('role/index', RoleIndex::class)->name('role');
            Route::get('role/create', RoleCreate::class)->name('create_role');
            Route::get('role/{role}/edit', RoleEdit::class)->name('edit_role');

            Route::get('page/index', PagesIndex::class)->name('pages.index');
            Route::get('page/create', PagesCreate::class)->name('pages.create');
            Route::get('page/{page}/edit', PagesEdit::class)->name('pages.edit');
            Route::get('page/{page}/delete', PagesDelete::class)->name('pages.delete');

            Route::get('courses', App\Http\Livewire\Admin\Course\Index::class)->name('courses.index');
            Route::get('courses/create', App\Http\Livewire\Admin\Course\Create::class)->name('course.create');
            Route::get('courses/{course}', App\Http\Livewire\Admin\Course\Edit::class)->name('course.edit');
            Route::get('courses/{course}/delete', App\Http\Livewire\Admin\Course\Index::class)->name('course.delete');

            Route::get('certifications', App\Http\Livewire\Admin\Certification\Index::class)->name('certifications.index');
            Route::get('certifications/create', App\Http\Livewire\Admin\Certification\Create::class)->name('certifications.create');
            Route::get('certifications/{certification}', App\Http\Livewire\Admin\Certification\Edit::class)->name('certifications.edit');
            Route::get('certifications/{certification}/delete', App\Http\Livewire\Admin\Certification\Index::class)->name('certifications.delete');

            Route::get('instructions', App\Http\Livewire\Admin\Instruction\Index::class)->name('instructions.index');
            Route::get('instructions/create', App\Http\Livewire\Admin\Instruction\Create::class)->name('instructions.create');
            Route::get('instructions/{instruction}', App\Http\Livewire\Admin\Instruction\Edit::class)->name('instructions.edit');
            Route::get('instructions/{instruction}/delete', App\Http\Livewire\Admin\Instruction\Index::class)->name('instructions.delete');

            Route::get('library', LibraryIndex::class)->name('library');
            Route::get('library/create', LibraryCreate::class)->name('library.create');
            Route::get('library/{library}', LibraryEdit::class)->name('library.edit');
            Route::get('library/{library}/delete', LibraryDelete::class)->name('library.delete');


            Route::get('partner/index', PartnerIndex::class)->name('partner');
            Route::get('partner/create', PartnerCreate::class)->name('create_partner');
            Route::get('partner/{partner}/edit', PartnerEdit::class)->name('edit_partner');
            Route::get('partner/{partner}/delete', PartnerDelete::class)->name('delete_partner');

            Route::get('settings', SettingsIndex::class)->name('settings');


            Route::get('payback_requests', PaybackRequestsIndex::class)->name('payback_requests');
            Route::get('payback_requests/{paybackRequest}/pay', PaybackRequestsPay::class)->name('payback_requests.pay');
        });
    });
});







