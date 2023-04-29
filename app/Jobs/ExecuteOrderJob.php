<?php

namespace App\Jobs;

use App\Models\Order;
use App\Services\BoostConnect;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExecuteOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle(): void
    {
        if ($this->order->status === 'success')
        {
            return;
        }

        $product_code = $this->order->product_code;
        $trxid = $this->order->id;
        $msisdn = $this->order->email;
        $userValidation = (array) json_decode($this->order->validation_fields);

        $json = BoostConnect::order($product_code,$trxid, $msisdn, $userValidation);
        $response = json_decode($json);

        if(isset($response->errorMessage))
        {
            $this->order->update([
                'response' => $json
            ]);
        }else{
            $this->order->update([
                'status' => 'success',
                'voucher_code' => $response->productPin,
                'response' => $json,
                'reference' => $response->vasTransID,
            ]);

            $this->dispatch(new SendMailNotif($this->order));

        }
    }
}
