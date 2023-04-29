<?php

return [
    'id_merchant' => env('MIDTRANS_ID_MERCHANT') ?? '',
    'client_key' => env('MIDTRANS_CLIENT_KEY') ?? '',
    'server_key' => env('MIDTRANS_SERVER_KEY') ?? '',
    'is_production' => env('MIDTRANS_IS_PRODUCTION') ?? false,
];
