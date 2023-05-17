<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $start_date = $request['start_date'] ?? date('Y-m-d');
        $end_date = $request['end_date'] ?? date('Y-m-d');

        $query = Order::query()
            ->select(['id','created_at','phone','email','game_code','product_code', 'status'])
            ->whereBetween(\DB::raw('date(created_at)'), [$start_date, $end_date])
            ->orderBy('id', 'desc');

        if ($request->get('game_code'))
        {
            $query->where('game_code','like', '%'.$request['game_code'].'%');
        }

        if ($request->get('product_code'))
        {
            $query->where('product_code','like', '%'.$request['product_code'].'%');
        }

        if ($request->get('phone'))
        {
            $query->where('phone','like', '%'.$request['phone'].'%');
        }

        if ($request->has('email'))
        {
            $query->where('email','like', '%'.$request['email'].'%');
        }

        $orders = $query->get();

        return view('admin.order.index', compact('orders'));

    }

    public function show(Order $order)
    {
        $activities = Activity::where('subject_type','App\Models\Order')
            ->where('subject_id', $order->id)
            ->orderBy('id','desc')
            ->get();
        return view('admin.order.show', compact('order', 'activities'));
    }
}
