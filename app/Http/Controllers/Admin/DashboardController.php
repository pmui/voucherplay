<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = Order::with(['payment','payment.paymentMethod', 'product', 'game'])->get();

        return view('admin.dashboard', ['transactions' => $transactions]);
    }
}
