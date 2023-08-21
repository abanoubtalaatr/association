<?php

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Front\ContactUs;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\MyFatoorahController;
use App\Http\Controllers\NotificationController;
use App\Http\Livewire\Admin\Settings as SettingsIndex;
use App\Http\Livewire\Admin\Role\Index as RoleIndex;
use App\Http\Livewire\Admin\Role\Edit as RoleEdit;
use App\Http\Livewire\Admin\Role\Create as RoleCreate;
use App\Http\Livewire\Admin\Admins\Index as AdminIndex;
use App\Http\Livewire\Admin\Admins\Edit as AdminEdit;
use App\Http\Livewire\Admin\Admins\Create as AdminCreate;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\User\ContactController as UserContactController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;


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
});

Route::post('/uploads/pics/certifications/users/{user_id}/{course_id}/{filename}/download', function ($user_id, $course_id, $filename){
 $certification = new \App\Services\CertificationService();
    $filePath = public_path("uploads/pics/certifications/users/$user_id/$course_id/$filename" . '.pdf');
    $user = User::query()->find($user_id);
    $course = Course::query()->find($course_id);

    $userCourse = \App\Models\CourseUser::query()
        ->where('course_id', $course_id)
        ->where('user_id', $user_id)
        ->where('pass_course', 1)
        ->where('attend_course', 1)
        ->first();

    if (!File::exists($filePath)) {
        if ($userCourse) {
            $certification = new \App\Services\CertificationService();
            $certification->storeCertificationForUser($user, $course);
        } else {
            abort(404);
        }
    }
    return $certification->downloadPdf('certification.pdf', $filePath);
})->name('download_pdf');
