<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Notifications\InvoiceNotification;
use App\Notifications\TrxSuccessNotification;
use App\Services\Midtrans;
use App\Services\MidtransResponseAdapter;
use Illuminate\Http\Request;
use Midtrans\Config;

class CheckoutController extends Controller
{
    public function __invoke(Request $request)
    {

        $product = Product::with('game')->where('product_code', $request->input('product_code'))->firstOrFail();
        $payment_method = PaymentMethod::where('name', $request->input('payment_method'))->firstOrFail();

        $order = Order::create([
            'email' => $request->input('email'),
            'game_code' => $product->game->code,
            'product_code' => $product->product_code,
            'price' => $product->price,
            'cost' => $product->cost,
            'status' => 'waiting payment',
            'validation_fields' => json_encode($request->input('account') ?? []),
            'user_id' => auth()->id() ?? null
        ]);

        $admin_fee = $request->input('admin_fee');
        $subtotal = $product->price;
        $total = $admin_fee + $subtotal;

        $order->payment()->create([
            'payment_method_id' => $payment_method->id,
            'subtotal' => $subtotal,
            'admin_fee' => $admin_fee,
            'total' => $total,
        ]);

        try {
            switch ($payment_method->code) {
                case 'gopay':
                    $midtrans = Midtrans::gopay($order);
                    break;
                case 'permata':
                    $midtrans = Midtrans::permata($order);
                    break;
                case 'bca':
                    $midtrans = Midtrans::bca($order);
                    break;
                case 'mandiri':
                    $midtrans = Midtrans::mandiri($order);
                    break;
                case 'bri':
                    $midtrans = Midtrans::bri($order);
                    break;
                case 'bni':
                    $midtrans = Midtrans::bni($order);
                    break;
                default:
                    // Handle invalid payment method.
                    $midtrans = Midtrans::qris($order);
                    break;
            }

            $response =  MidtransResponseAdapter::read($midtrans);

            $order->payment()->update($response);

            $order->notify(new InvoiceNotification($order));

            return redirect(route('order.show', $order));

        } catch (\Exception $exception)
        {
            $order->update(['status' => 'failed']);
            return $exception->getMessage();
        }



    }
}
