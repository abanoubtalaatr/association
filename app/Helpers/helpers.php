<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

if (!function_exists('sendMessageToWhatsApp')) {
    function sendMessageToWhatsApp($mobile, $message, $mediaUrl)
    {
        //if send message with file
        if (!is_null($mediaUrl)) {
            $params = "?number=" . '966' . $mobile . '&type=media&message=' . "$message" . '&media_url=' . $mediaUrl . '&filename=adsoldiers.pdf' . '&instance_id=' . env('KARZOUN_INSTANCE_ID') . '&access_token=' . env('KARZOUN_ACCESS_TOKEN');
            $url = env('KARZOUN_URL') . $params;
            info('the url from kurzon' . $url);
            return Http::get($url);
        } else {// this for sending message only
            $params = "?number=" . '966' . $mobile . '&type=message&message=' . "$message" . '&instance_id=' . env('KARZOUN_INSTANCE_ID') . '&access_token=' . env('KARZOUN_ACCESS_TOKEN');
            $url = env('KARZOUN_URL') . $params;
            info('sending message only' . $url);
            return Http::get($url);
        }

    }
}

if (!function_exists('sendSms')) {
    function sendSms($mobile, $code)
    {
        $url = env('SMS_URL') . "?api_id=" . env('SMS_API_KEY') . "&api_password=" . env('SMS_PASSWORD') . "&sms_type=T&encoding=T&sender_id=" . env('SENDER_ID') . "&phonenumber=" . $mobile . "&textmessage=Your Code " . $code . "&uid=xyz&callback_url=https://xyz.com";
        $response = Http::get($url);
        return json_decode($response->getBody()->getContents(), true);
    }
}



