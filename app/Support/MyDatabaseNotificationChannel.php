<?php
namespace App\Support;

class MyDatabaseNotificationChannel{
    public function send($notifiable, MyDatabaseNotificationInterface  $notification){
        return $notifiable->routeNotificationFor('database')->create($notification->toMyDatabase($notifiable));
    }
}
