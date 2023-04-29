<?php

namespace App\Services;

class MidtransResponseAdapter
{
    public static function read($response): array
    {
        $output = [];

        if ($response->status_code != '201')
        {
            return [];

        }

        $output['reference'] = $response->transaction_id;

        if(isset($response->va_numbers))
        {
            $output['va_number'] = $response->va_numbers[0]->va_number;
        }

        if(isset($response->permata_va_number))
        {
            $output['va_number'] = $response->permata_va_number;
        }

        if(isset($response->echannel))
        {
            $output['va_number'] = $response->biller_code . $response->bill_key;
        }

        if(isset($response->actions))
        {
            $output['links'] = $response->actions;
        }

        return $output;
    }
}