<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // public function store(OrderRequest $request)
    // {

    //     $order = OrderRepository::storeByRequest($request);

    //     return back()->withSuccess('Order Created Successfully');
    // }

    public function orderStore(Request $request)
    {
        $order = OrderRepository::storeByRequest($request);
        return to_route('root')->withSuccess('Order Created Successfully');
    }
}
