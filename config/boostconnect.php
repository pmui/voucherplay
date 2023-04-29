<?php

return [
    'vasServer' => env('BC_VAS') ?? 'https://digital-voucher-api-stg.apigate.com/',
    'apiKey' => env('BC_APIKEY') ?? '',
    'publisherCode' => env('BC_PUBLISHERCODE') ?? '',
    'operator' => env('BC_OPERATOR') ?? '',
    'onBehalfOf' => env('BC_BEHALFOF') ?? '',
    'contactInfo' => env('BC_CONTACTINFO') ?? '',
    'tacVerification' => env('BC_TAC') ?? '0',
    'tacMode' => env('BC_TACMODE') ?? '0',
    'chargingType' => env('BC_CHARGINGTYPE') ?? 'N',
    'smsDelivery' => env('BC_SMS') ?? '0',

];
