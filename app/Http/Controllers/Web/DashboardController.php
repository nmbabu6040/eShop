<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('web.dashboard.index');
    }

    public function orders()
    {
        $user = auth('web')->user();
        $orders = $user->orders;
        return view('web.dashboard.orders', compact('orders'));
    }

    public function orderDetails(Order $order)
    {
        return view('web.dashboard.order_details', compact('order'));
    }
}
