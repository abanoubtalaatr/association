<!DOCTYPE html>
<html>
<head>
    <title>{{$page_title}}</title>
    <style>
        .wpwl-container{
            margin:  10% auto;
        }
    </style>

    <script
        src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
    <script src="{{config('payment.payment_widget_url')}}.js?checkoutId={{ $checkout_id }}"></script>
</head>
<body>

<form
    action="{{route('user.confirm_pay_ad')}}"
    class="paymentWidgets" data-brands="VISA MASTER AMEX"></form>


</body>
</html>
