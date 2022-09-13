<?php

return [

    /*
     * Project`s public key
     */
    'public_key' => env('UNITPAY_PUBLIC_KEY', '440055-c2bf8'),

    /*
     * Project`s secret key
     */
    'secret_key' => env('UNITPAY_SECRET_KEY', 'aff6455500ee0d0a83a003ad8f985883'),

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
    'searchOrder' => 'App\Http\Controllers\Site\UnitPayController@searchOrder', //  'App\Http\Controllers\UnitPayController@searchOrder',

    /*
     *  PaidOrder
     *  If current _orderStatus from DB != paid then call PaidOrderFilter
     *  update order into DB & other actions
     */
    'paidOrder' => 'App\Http\Controllers\Site\UnitPayController ::class', //  'App\Http\Controllers\UnitPayController@paidOrder',

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
