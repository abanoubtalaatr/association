<?php

namespace App\Services;

use App\Models\Ad;
use App\Models\User;

class HyperpayService
{
    public static function prepareCheckout($amount = 0, User $user)
    {
        $url = config('payment.base_url') . "/checkouts";
        $transaction_id = mt_getrandmax() . "" . date('YmdHis');
        $customer_email = $user->email;
        $billing_street1 = "Street";
        $billing_state = "Ryad";
        $billing_city = "Ryad";
        $post_code = "12211";
        $customer_givenname = $user->username;
        $customer_surname = $customer_givenname;
        $data = "entityId=" . config('payment.entity_id') .
            "&testMode=EXTERNAL" .
            "&merchantTransactionId=" . $transaction_id .
            "&customer.email=" . $customer_email .
            "&billing.street1=" . $billing_street1 .
            "&billing.city=" . $billing_city .
            "&billing.state=" . $billing_state .
            "&billing.country=SA" .
            "&billing.postcode=" . $post_code .
            "&customer.givenName=" . $customer_givenname .
            "&customer.surname=" . $customer_surname .
            "&amount=" . $amount .
            "&currency=SAR" .
            "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer ' . \config('payment.token')));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return json_decode($responseData, true);
    }

    public static function getPaymentStatus($payment_id)
    {
        $url = config('payment.base_url') . "/checkouts/$payment_id/payment";
        $url .= "?entityId=" . config('payment.entity_id');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization:Bearer ' . config('payment.token')]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return json_decode($responseData, true);
    }


}
