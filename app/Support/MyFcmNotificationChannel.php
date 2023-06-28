<?php

namespace App\Support;

class MyFcmNotificationChannel
{
    public function send($notifiable, MyFcmNotificationInterface $notification)
    {
        $notification = $notification->getFcmData($notifiable);
        $device_tokens = $notifiable->devices()->pluck('device_token', 'type');
        foreach ($device_tokens as $device_type => $single_device_token) {
            $this->sendSingle($single_device_token, $device_type, $notification);
        }
    }

    private function sendSingle($single_device_token, $device_type, $notification)
    {
        $customData = array_merge($notification, ["priority" => "high", "visibility" => "public", "importance" => "max"]);
        $notification_data = array_merge(
            [
                "body" => $notification['content_ar'],
                "title" => $notification['title_ar'],
                'badge' => 1,
            ],
            $customData
        );
        $data = [
            "to" => $single_device_token,
            "notification" => $notification_data,
        ];

        if ($device_type == 'ios') {
            $data['notification'] = $notification_data;
        }

        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = $data;
        $fields = json_encode($fields);

        $headers = [
            "Content-Type: application/json",
            "Accept: application/json",
            "Authorization:key=" . config('fcm.http.server_key')

        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec($ch);
        curl_close($ch);
    }


}
