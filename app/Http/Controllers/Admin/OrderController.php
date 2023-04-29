<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $start_date = $request['start_date'] ?? date('Y-m-d');
        $end_date = $request['end_date'] ?? date('Y-m-d');

        $orders = Order::query()
            ->select(['id','created_at','phone','email','game_code','product_code', 'status'])
            ->whereBetween(\DB::raw('date(created_at)'), [$start_date, $end_date])
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.order.index', compact('orders'));

    }

    public function show(Order $order)
    {
        return view('admin.order.show', compact('order'));
    }
}
