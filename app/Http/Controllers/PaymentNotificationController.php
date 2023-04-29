<?php

namespace App\Http\Controllers;

use App\Jobs\ExecuteOrderJob;
use App\Jobs\SendMailNotif;
use App\Models\Order;
use App\Models\Payment;
use Midtrans\Notification;

class PaymentNotificationController extends Controller
{
    public function __invoke()
    {
        try {
            $notif = new Notification();
            $notif = $notif->getResponse();

            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $order_id = $notif->order_id;
            $fraud = $notif->fraud_status;
            $expiry_time = $notif->expiry_time ?? null;

            $log = $this->updateTransaction($transaction, $type, $order_id, $fraud, $expiry_time);

            Payment::where('order_id', $order_id)->update(['status' => $transaction]);

            \Log::debug($log);

            return $log;
        } catch (\Exception $e) {
            exit($e->getMessage());
        }


    }

    private function updateTransaction($transaction, $type, $order_id, $fraud, $expiry_time)
    {
        $order = Order::find($order_id);

        switch ($transaction) {
            case 'capture':
                if ($type == 'credit_card') {
                    return ($fraud == 'challenge') ?
                        "Transaction order_id: $order_id is challenged by FDS" :
                        "Transaction order_id: $order_id successfully captured using $type";
                }
                break;
            case 'settlement':
                $order->update(['status' => 'paid']);
                $this->dispatch(new ExecuteOrderJob($order));
                return "Transaction order_id: $order_id successfully transferred using $type";
            case 'pending':
                $order->update(['status' => 'waiting payment']);
                Payment::where('order_id', $order_id)->update(['expire' => $expiry_time]);
                return "Waiting customer to finish transaction order_id: $order_id using $type";
            case 'deny':
                $order->update(['status' => 'failed']);
                return "Payment using $type for transaction order_id: $order_id is denied.";
            case 'expire':
                $order->update(['status' => 'failed']);
                return "Payment using $type for transaction order_id: $order_id is expired.";
            case 'cancel':
                $order->update(['status' => 'failed']);
                return "Payment using $type for transaction order_id: $order_id is canceled.";
        }
    }
}
