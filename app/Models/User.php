<?php

namespace App\Models;

use App\Models\Camp;
use Illuminate\Support\Str;
use App\Services\FCMService;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use App\Services\GenerateCodeService;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }


    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_users', 'user_id')->withPivot('attend_course', 'pass_course');
    }

    public function devices()
    {
        return $this->hasMany(UserDevice::class);
    }

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function notPaidWallets()
    {
        return $this->hasMany(Wallet::class)->whereNull('payback_request_id');
    }

    public function paybackRequests()
    {
        return $this->hasMany(PaybackRequest::class);
    }

    public function statsSessionsSoldier()
    {
        return $this->hasMany(StatsSessionsSoldier::class)->where('item_type', 'ad');
    }

    public function statsLibrarySessionsSoldier()
    {
        return $this->belongsToMany(Library::class, 'stats_sessions_soldier', 'user_id', 'ad_id')->wherePivot('item_type', 'library')->withPivot('visitors_number');
    }

    public function statsAgeSoldier()
    {
        return $this->hasMany(StatsAgeSoldier::class);
    }

    public function statsCountrySoldier()
    {
        return $this->hasMany(StatsCountrySoldier::class);
    }

    public function statsGenderSoldier()
    {
        return $this->hasMany(StatsGenderSoldier::class);
    }

    public function statsAudienceSoldier()
    {
        return $this->hasMany(StatsAudienceSoldier::class);
    }

    public function statsAudienceSoldierView()
    {
        return $this->hasMany(StatsAudienceSoldierView::class);
    }

    public function statsCitySoldierView()
    {
        return $this->hasMany(StatsCitySoldierView::class);
    }


    public function getAllowedToShowAdsAttribute()
    {
        return $this->last_share == 'library';
    }

    public function getStatusClassAttribute()
    {
        return $this->is_active == 1 ? 'green' : 'yellow';
    }

    public function getStatusAttribute()
    {
        return $this->is_active == 1 ? 'active' : 'inactive';
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar == 'default_user_avatar.png' ? asset('frontAssets/assets_' . app()->getLocale() . '/imgs/home/logo.svg')
            :
            url('uploads/pics/' . $this->avatar);
    }


    public function filters()
    {
        return $this->hasMany(Filter::class);
    }


    public function libraryProfits()
    {
        return $this->hasMany(LibraryProfit::class, 'soldier_id');
    }


    //JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
