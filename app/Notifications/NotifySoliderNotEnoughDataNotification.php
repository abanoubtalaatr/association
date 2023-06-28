<?php

namespace App\Notifications;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Support\{MyFcmNotificationInterface, MyFcmNotificationChannel, MyDatabaseNotificationInterface, MyDatabaseNotificationChannel};


class NotifySoliderNotEnoughDataNotification extends Notification implements MyDatabaseNotificationInterface, MyFcmNotificationInterface, ShouldQueue{
    use Queueable;
    public $ad_id;
    public function __construct(){
//        $this->ad_id = $ad_id;
//        dd($no)
    }

    public function via($notifiable){
        return [MyDatabaseNotificationChannel::class, MyFcmNotificationChannel::class];
    }

    public function toMyFcm($notifiable){}

    public function getFcmData($notifiable){
//        dd($notifiable);
        $subject_id = $notifiable->id;
        $title_ar = 'أدسولجرز';
        $title_en = 'Adsoldiers';
        $type = 'not_enough_data';
        $settings = Setting::first();

        $content_ar = "شارك الإعلان مع أكبر عدد ممكن من المجموعات المناسبة حتى تحصل على رصيد  $settings->solider_ad_max_profit  ريال";

        $content_en = ("Share the ad with as many appropriate groups as you can in order to get credit $settings->solider_ad_max_profit ryal .");

            return array_merge(
            ['user_id'=>$notifiable->id,'subject_id'=>$subject_id],
            compact('title_ar','title_en','content_ar','content_en','type','subject_id')
        );
    }

    public function toMyDatabase($notifiable){
        $subject_id = $notifiable->id;
        $title_ar = 'أدسولجرز';
        $title_en = 'Adsoldiers';
        $type = 'not_enough_data';
        $settings = Setting::first();

        $content_ar = "شارك الإعلان مع أكبر عدد ممكن من المجموعات المناسبة حتى تحصل على رصيد  $settings->solider_ad_max_profit  ريال";
        $content_en = ("Share the ad with as many appropriate groups as you can in order to get credit $settings->solider_ad_max_profit ryal .");
            return array_merge(
            ['user_id'=>$notifiable->id,'subject_id'=>$subject_id],
            compact('title_ar','title_en','content_ar','content_en','type','subject_id')
        );
    }
}
