<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
// 引入
use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request) 
    {
        $orderCount = Order::count();
        $dataPerPage = 1;
        $orderPages = ceil($orderCount / $dataPerPage);
        $currentPage = isset($request->all()['page']) ? $request->all()['page'] : 1 ;

        $orders = Order::orderBy('created_at','desc')
        ->offset($dataPerPage * ($currentPage - 1))
        ->limit($dataPerPage)
        ->get();

        return view('admin.orders.index' , 
        ['orders' => $orders,
         'orderCount' => $orderCount,
         'orderPages' => $orderPages]);
    }
}
