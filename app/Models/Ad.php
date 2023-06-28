<?php

namespace App\Models;

use App\Services\AdsFilterService;
use App\Services\FCMService;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ad extends Model{
    use HasFactory;
    protected $guarded = [];
    protected $casts=['media'=>'object','start_date'=>'date','payment_info'=>'object'];


    public function adProfits(){
        return $this->hasMany(AdProfit::class);
    }

    public function getStartDateAttribute(){
        return date('Y-m-d',strtotime($this->attributes['start_date']));
    }

    public function getClicksCountAttribute(){
        return $this->total_clicks;
    }

    public function getIsPaidAttribute(){
        return $this->payment_info? true : false;
    }



    public function getStatusClassAttribute(){
        return $this->status == 'active' || $this->status =='finished'? 'green' : ( $this->status=='inactive'? 'red' : 'yellow');
    }

    public function getMediaPreviewUrlAttribute(){
        return url('uploads/pics/'.$this->media[0]);
    }

    public function getWhatsappThumbnailUrlAttribute(){
        return url('uploads/pics/'.$this->whatsapp_thumbnail);
    }



    public function camp(){
        return $this->belongsTo(Camp::class);
    }

    public function advertiser(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function genders(){
        return $this->belongsToMany(Gender::class);
    }

    public function countries(){
        return $this->belongsToMany(Country::class);
    }

     public function cities(){
        return $this->belongsToMany(City::class);
    }

    public function audiences(){
        return $this->belongsToMany(Audience::class);
    }

    public function ages(){
        return $this->belongsToMany(Age::class);
    }

    public function languages(){
        return $this->belongsToMany(Language::class);
    }

    public function soldiers(){
        return $this->hasMany(StatsSessionsSoldier::class);
    }

    public function statsAges(){
        return $this->belongsToMany(Age::class,'stats_age_soldier','item_id','age_id')->wherePivot('item_type','ad')->withPivot('visitors_number');
    }

    public function statsAudiences(){
        return $this->belongsToMany(Audience::class,'stats_audience_soldier','item_id','audience_id')->wherePivot('item_type','ad')->withPivot('visitors_number');
    }

    public function statsCities(){
        return $this->belongsToMany(City::class,'stats_city_soldier','item_id','city_id')->wherePivot('item_type','ad')->withPivot('visitors_number');
    }

    public function statsCountries(){
        return $this->belongsToMany(Country::class,'stats_country_soldier','item_id','country_id')->wherePivot('item_type','ad')->withPivot('visitors_number');
    }


    public function statsGenders(){
        return $this->belongsToMany(Gender::class,'stats_gender_soldier','item_id','gender_id')->wherePivot('item_type','ad')->withPivot('visitors_number');
    }


    protected static function boot(){
        parent::boot();
        static::creating(function ($query) {
            $query->remaining_budget = 0;
            $query->status = 'unpaid';
        });

        static::updated(function($model){
            if($model->isDirty('status') && $model->status !='inactive' && $model->status != 'finished'){
                $notifiable = $model->advertiser;

                $title_ar = 'أدسولجرز';
                $title_en = 'Adsoldiers';

                app()->setLocale('ar');
                $content_ar = sprintf('تم تغيير حالة الإعلان رقم %s الى %s',$model->id,__('site.'.$model->status));

                app()->setLocale('en');
                $content_en = sprintf('Advertisement number %s was changed to %s',$model->id,__('site.'.$model->status));

                $title = ($notifiable->default_language=='ar')? $title_ar : $title_en;
                $body = ($notifiable->default_language=='ar')? $content_ar : $content_en;
                $type = 'ad_status_changed';
                $subject_id = $model->id;


                FCMService::spark_send_fcm(
                    $notifiable,
                    $title,
                    $body,
                    compact('content_ar','content_en','title_ar','title_en','type','subject_id')
                );
            }

            if($model->isDirty('status') && $model->status=='active'){
                $notifiable = $model->advertiser;

                $title_ar = 'أدسولجرز';
                $title_en = 'Adsoldiers';

                app()->setLocale('ar');
                $content_ar = sprintf('إعلان جديد يناسب إهتماماتك');

                app()->setLocale('en');
                $content_en = sprintf('A new Advertisement that may match your interests');

                $title = ($notifiable->default_language=='ar')? $title_ar : $title_en;
                $body = ($notifiable->default_language=='ar')? $content_ar : $content_en;
                $type = 'soldier_new_ad';
                $subject_id = $model->id;



                $target_soldiers = AdsFilterService::getAdSoldiersQuery($model->id)->get();
                foreach($target_soldiers as $notifiable){
//                    FCMService::spark_send_fcm(
//                        $notifiable,
//                        $title,
//                        $body,
//                        compact('content_ar','content_en','title_ar','title_en','type','subject_id')
//                    );
                    info('the user is ' . $notifiable);;
                    $notifiable->notify(new \App\Notifications\NewAdNotification($model->id));
                }

            }
        });



    }

}
