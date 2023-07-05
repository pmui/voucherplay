<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailNotif;
use App\Models\Order;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        return view('order_detail', ['order'=>$order]);
    }

    public function resendMail(Order $order)
    {
        $this->dispatch(new SendMailNotif($order));
        return view('resend_success', compact($order));
    }

    public function history()
    {
        $this->middleware = ['auth'];

        $orders = \Auth::user()->orders;

        return view('history', compact('orders'));


    }
}
