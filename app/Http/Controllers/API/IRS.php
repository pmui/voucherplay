<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\BoostConnect;
use Illuminate\Http\Request;

class IRS extends Controller
{
    public function order(Request $request)
    {
//        dd($request->ip());
        $product_code = $request->input('product_code');
        $trxid = $request->input('trxid');
        $msisdn = $request->input('msisdn');

        $response =  BoostConnect::order($product_code, $trxid, $msisdn);
        $response = json_decode($response);

        $output = [
            'trxid' =>  $trxid,
            'kp' =>  $product_code,
            'tujuan' =>  $msisdn,
        ];

        if(isset($response->errorMessage))
        {
            $output['success'] = false;
            $output['msg'] = $response->errorMessage ?? "Terjadi kesalahan. Cobalah beberapa saat lagi";
        }else{
            #IRS hanya mengenal SN
            $output['success'] = true;
            $output['sn'] = $response->productPin;
            $output['msg'] = "Pembelian voucer game $product_code tujuan $msisdn berhasil";

        }

        return response()->json($output);
    }
}
