<?php

namespace App\Services;

use App\Models\Order;
use Midtrans\CoreApi;

class Midtrans
{
    public static function charge(Order $order, $paymentType, $bank = null)
    {
        $transactionDetails = [
            'order_id'      => $order->id,
            'gross_amount'  => $order->payment->total,
        ];

        $items = [
            [
                'id'       => $order->product_code,
                'price'    => $order->payment->subtotal,
                'quantity' => 1,
                'name'     => $order->product->name
            ],
            [
                'id'       => 'adm',
                'price'    => $order->payment->admin_fee,
                'quantity' => 1,
                'name'     => 'Admin Fee'
            ]
        ];

        $customerDetails = [
            'first_name' => "Guest",
            'last_name'  => "Non Member",
            'email'      => $order->email,
            'phone'      => $order->phone ?? '081',
        ];

        $transactionData = [
            'payment_type'         => $paymentType,
            'transaction_details'  => $transactionDetails,
            'item_details'         => $items,
            'customer_details'     => $customerDetails,
        ];

        if ($bank === 'bri' || $bank === 'bni' || $bank === 'bca') {
            $transactionData['bank_transfer'] = [
                'bank' => $bank,
            ];
        } elseif ($paymentType === 'echannel') {
            $transactionData['echannel'] = [
                'bill_info1' => 'Payment:',
                'bill_info2' => 'Online Purchase',
            ];
        }

        try {
            $response = CoreApi::charge($transactionData);
            return $response;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public static function gopay(Order $order)
    {
        return self::charge($order, 'gopay');
    }

    public static function qris(Order $order)
    {
        return self::charge($order, 'qris');
    }

    public static function permata(Order $order)
    {
        return self::charge($order, 'permata');
    }

    public static function mandiri(Order $order)
    {
        return self::charge($order, 'echannel');
    }

    public static function bri(Order $order)
    {
        return self::charge($order, 'bank_transfer', 'bri');
    }

    public static function bni(Order $order)
    {
        return self::charge($order, 'bank_transfer', 'bni');
    }

    public static function bca(Order $order)
    {
        return self::charge($order, 'bank_transfer', 'bca');
    }
}
