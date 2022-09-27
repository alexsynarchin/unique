<?php

return [

    /*
     * Project`s public key
     */
    'public_key' => env('UNITPAY_PUBLIC_KEY', ''),

    'public_key_netting' => env('UNITPAY_PUBLIC_KEY_NETTING', ''),

    /*
     * Project`s secret key
     */
    'secret_key' => env('UNITPAY_SECRET_KEY', ''),

    'secret_key_netting' => env('UNITPAY_SECRET_KEY_NETTING', ''),

    /*
     * Locale for payment form
     */
    'locale' => 'ru',  // ru || en

    /*
     * Allowed ip's http://help.unitpay.ru/article/67-ip-addresses
     */
    'allowed_ips' => [
        '31.186.100.49',
        '178.132.203.105',
        '178.214.249.201',
        '52.29.152.23',
        '52.19.56.234',
        '172.19.0.1'
    ],

    /*
     * Currency for payment
     * RUB, UAH, BYN, EUR, USD
     */
    'currency' => 'RUB',

    /*
     *  SearchOrder
     *  Search order in the database and return order details
     *  Must return array with:
     *
     *  _orderStatus
     *  _orderSum
     */
    'searchOrder' => [App\Http\Controllers\Site\UnitPayController::class,'searchOrder'], //  'App\Http\Controllers\UnitPayController@searchOrder',

    /*
     *  PaidOrder
     *  If current _orderStatus from DB != paid then call PaidOrderFilter
     *  update order into DB & other actions
     */
    'paidOrder' => [App\Http\Controllers\Site\UnitPayController ::class, 'paidOrder'], //  'App\Http\Controllers\UnitPayController@paidOrder',

    /*
     * Customize error messages
     */
    'errors' => [
        'invalidRequest' => 'Invalid Request',
        'validateOrderFromHandle' => 'Validate Order Error',
        'searchOrder' => 'Search Order Error',
        'paidOrder' => 'Paid Order Error',
    ],

    /*
     * Url to init payment on UnitPay
     * https://help.unitpay.ru/article/31-creating-payment-from-payment-form
     */
    'pay_url' => 'https://unitpay.ru/pay/',
];
