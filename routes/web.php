<?php

use App\Models\Ad;
use App\Models\AdDevices;
use App\Models\AdTime;
use App\Models\AdUser;
use App\Models\Course;
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
use Illuminate\Support\Facades\File;
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
use setasign\Fpdi\Tcpdf\Fpdi;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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

Route::get('adham', function () {
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
//    Route::get('/', [HomeController::class, 'index'])->name('homepage');
    Route::redirect('/', '/user/login');
    Route::get('contact-us', ContactUs::class)->name('contact_us');
    Route::get('page/{page}', [HomeController::class, 'showPage'])->name('show_page');


    Route::group(['as' => 'user.', 'prefix' => 'user/'], function () {
        Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register_form');
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login_form')
            ->middleware('checkUserIsLogin');
        Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');
        Route::get('verify-forget-password-code/{user}', [AuthController::class, 'verifyForgetPasswordCode'])->name('verify_forget_password_code');
        Route::get('verify-register-code', [AuthController::class, 'verifyRegisterCode'])->name('verify_register_code');
        Route::post('verify-register-code', [AuthController::class, 'verifyRegisterCodePost'])->name('verify_registration_code');
        Route::post('send-verify-code', [AuthController::class, 'resendOtpCode'])->name('resend_verification_code');


        Route::group(['middleware' => 'auth:users'], function () {
            Route::get('notifications', [NotificationController::class, 'userNotification'])->name('notifications.index');
            Route::get('logout', [AuthController::class, 'logout'])->name('logout');

            Route::get('profile', [AuthController::class, 'profile'])->name('edit_profile');
            Route::post('save-profile', [AuthController::class, 'saveProfile'])->name('save_profile');

            Route::get('dashboard', [UserDashboardController::class, 'courses'])->name('dashboard');

            Route::get('contact', [UserContactController::class, 'index'])->name('contact_us');
            Route::get('courses', [UserDashboardController::class, 'courses'])->name('courses');

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

            Route::get('users', \App\Http\Livewire\Admin\Users\Index::class)->name('users.index');
            Route::get('users/{user}/courses', \App\Http\Livewire\Admin\Users\Courses::class)->name('user_courses');
            Route::get('users/{user}/edit', \App\Http\Livewire\Admin\Users\Edit::class)->name('users.edit');


            Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');
            Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

            Route::get('role/index', RoleIndex::class)->name('role');
            Route::get('role/create', RoleCreate::class)->name('create_role');
            Route::get('role/{role}/edit', RoleEdit::class)->name('edit_role');

            Route::get('courses', App\Http\Livewire\Admin\Course\Index::class)->name('courses.index');
            Route::get('courses/create', App\Http\Livewire\Admin\Course\Create::class)->name('course.create');
            Route::get('courses/{course}', App\Http\Livewire\Admin\Course\Edit::class)->name('course.edit');
            Route::get('courses/{course}/delete', App\Http\Livewire\Admin\Course\Index::class)->name('course.delete');

            Route::get('certifications', App\Http\Livewire\Admin\Certification\Index::class)->name('certifications.index');
            Route::get('certifications/create', App\Http\Livewire\Admin\Certification\Create::class)->name('certifications.create');
            Route::get('certifications/{certification}', App\Http\Livewire\Admin\Certification\Edit::class)->name('certifications.edit');
            Route::get('certifications/{certification}/delete', App\Http\Livewire\Admin\Certification\Index::class)->name('certifications.delete');

            Route::get('settings', SettingsIndex::class)->name('settings');

        });
    });
});


Route::get('/uploads/pics/certifications/users/{user_id}/{course_id}/{filename}', function ($user_id, $course_id, $filename) {

    $course = Course::query()->find($course_id);
    if ($course) {
        if (Carbon::parse($course->valid_to)->format('Y-m-d') < now()->format('Y-m-d')) {
            return view('certification');
        }
    }
    $user = User::query()->find($user_id);

    $userCourse = \App\Models\CourseUser::query()
        ->where('course_id', $course_id)
        ->where('user_id', $user_id)
        ->where('pass_course', 1)
        ->where('attend_course', 1)
        ->first();
    //must print certification if not exist
    $filePath = public_path("uploads/pics/certifications/users/$user_id/$course_id/$filename" . '.pdf');

    if (!File::exists($filePath)) {
        if ($userCourse) {
            $certification = new \App\Services\CertificationService();
            $certification->storeCertificationForUser($user, $course);
        } else {
            abort(404);
        }

    }

    $headers = [
        'Content-Type' => 'application/pdf',
    ];

    return response()->file($filePath, $headers);
})->where('filename', '(.*)');

