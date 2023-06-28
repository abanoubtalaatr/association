<?php

namespace App\Notifications\Drivers;

use App\Models\Ad;
use Illuminate\Bus\Queueable;
use Benwilkins\FCM\FcmMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Resources\OrderNotificationResource;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class TestNotification extends Notification  implements ShouldBroadcastNow{
    use Queueable;
    public $ad;
    public function __construct(Ad $ad){
        $this->ad = $ad;
    }

    public function via($notifiable){
        return ['fcm'];
    }


    public function toFcm($notifiable){
        $message = new FcmMessage();
        $content = [
            'title'=>'طلب جديد',
            'body'=>'طلب جديد',
            'title_en'        => 'New order placed',
            'title_ar'=>'طلب جديد',
            'body_en'         => 'New order placed',
            'body_ar'=>'طلب جديد',
            'order'        => new OrderNotificationResource($this->order),
            'type'=>'new_order'
        ];
        $message->content($content)->data($content)->priority(FcmMessage::PRIORITY_HIGH);

        return $message;
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
