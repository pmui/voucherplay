<?php

namespace App\Services;

class BoostConnect
{

    public static function getCategoryList()
    {
        $endpoint = 'api/retrieveProductCategory';
        $response =  \Http::asForm()->post(config('boostconnect.vasServer').$endpoint,[
            'apiKey' => config('boostconnect.apiKey'),
            'publisherCode' => config('boostconnect.publisherCode')
        ]);

        return $response->body();
    }

    public static function getProductList($product_category = '')
    {
        $endpoint = 'api/retrieveProductList';
        $response =  \Http::asForm()->post(config('boostconnect.vasServer').$endpoint,[
            'apiKey' => config('boostconnect.apiKey'),
            'publisherCode' => config('boostconnect.publisherCode'),
            'productCategory' => $product_category,
            'operator' => config('boostconnect.operator')
        ]);

        return $response->body();
    }

    public static function order($product_code, $trxId, $msisdn = '0',$userValidation = [] )
    {
        $endpoint = 'api/orderProduct';
        $response =  \Http::asForm()->post(config('boostconnect.vasServer').$endpoint,[
            'apiKey' => config('boostconnect.apiKey'),
            'spTransID' => $trxId,
            'publisherCode' => config('boostconnect.publisherCode'),
            'productCode' => $product_code,
            'onBehalfOf' => config('boostconnect.onBehalfOf'),
            'msisdn' => $msisdn,
            'operator' => config('boostconnect.operator'),
            'contactInfo' => config('boostconnect.contactInfo'),
            'tacVerification' => config('boostconnect.tacVerification'),
            'tacMode' => config('boostconnect.tacMode'),
            'chargingType' => config('boostconnect.chargingType'),
            'smsDelivery' => config('boostconnect.smsDelivery'),
            'userValidationFields' => json_encode($userValidation),
        ]);

        return $response->body();
    }

    public static function validateAccount($product_code, $userValidation = [] )
    {
        $endpoint = 'api/validateUserAccount';
        $response =  \Http::asForm()->post(config('boostconnect.vasServer').$endpoint,[
            'apiKey' => config('boostconnect.apiKey'),
            'publisherCode' => config('boostconnect.publisherCode'),
            'productCode' => $product_code,
            'operator' => config('boostconnect.operator'),
            'userValidationFields' => json_encode($userValidation),
        ]);

        return $response->body();
    }
}
