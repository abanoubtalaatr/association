<html>
    <head>
        <title>{{$page_title}}</title>
    </head>
    <body>
        <script
        src='{{config('Payment.gateway_url')}}/checkout/version/62/checkout.js'
        data-error='erroCallback'
        data-cancel='{{route('failed-payment',$order_id)}}'
        ></script>
        <script>
            Checkout.configure({
                merchant: '{{config('Payment.merchant_id')}}',
                order: {
                    amount: function() {
                        return {{$amount}};
                    },
                    currency: '{{config('Payment.currency')}}',
                    description: '{{$description}}'
                },
                interaction: {
                    merchant: {
                        name: '{{config('app.name')}}'
                    }
                },
                session:{
                    id:'{{$session_id}}'
                }
            });
            Checkout.showPaymentPage();
        </script>
    </body>
</html>
