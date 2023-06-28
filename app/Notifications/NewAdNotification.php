<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Support\{MyFcmNotificationInterface, MyFcmNotificationChannel, MyDatabaseNotificationInterface, MyDatabaseNotificationChannel};


class NewAdNotification extends Notification implements MyDatabaseNotificationInterface, MyFcmNotificationInterface, ShouldQueue{
    use Queueable;
    public $ad_id;
    public function __construct($ad_id){
        $this->ad_id = $ad_id;
    }

    public function via($notifiable){
        return [MyDatabaseNotificationChannel::class, MyFcmNotificationChannel::class];
    }

    public function toMyFcm($notifiable){}

    public function getFcmData($notifiable){
        $subject_id = $this->ad_id;
        $title_ar = 'أدسولجرز';
        $title_en = 'Adsoldiers';
        $type = 'soldier_new_ad';

        $content_ar = 'لديك إعلان جديد للنشر';
        $content_en = 'You have a new ads for sharing ';
            return array_merge(
            ['user_id'=>$notifiable->id,'subject_id'=>$subject_id],
            compact('title_ar','title_en','content_ar','content_en','type','subject_id')
        );
    }

    public function toMyDatabase($notifiable){
        $subject_id = $this->ad_id;
        $title_ar = 'أدسولجرز';
        $title_en = 'Adsoldiers';
        $type = 'ad_finished';

        $content_ar = 'لديك إعلان جديد للنشر';
        $content_en ='You have a new ad for sharing';
            return array_merge(
            ['user_id'=>$notifiable->id,'subject_id'=>$subject_id],
            compact('title_ar','title_en','content_ar','content_en','type','subject_id')
        );
    }
}
