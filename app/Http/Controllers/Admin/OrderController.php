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
        $orderCount = Order::whereHas('orderItems')->count();
        $dataPerPage = 2;
        $orderPages = ceil($orderCount / $dataPerPage);
        $currentPage = isset($request->all()['page']) ? $request->all()['page'] : 1;
        // 解省校能，先引入資料 with(['user', 'orderItems.product']) , product與orderItems相關
        $orders = Order::with(['user', 'orderItems.product'])->orderBy('created_at', 'desc')
            ->offset($dataPerPage * ($currentPage - 1))
            ->limit($dataPerPage)
            ->whereHas('orderItems') // 建立子查詢
            ->get();

        return view(
            'admin.orders.index',
            [
                'orders' => $orders,
                'orderCount' => $orderCount,
                'orderPages' => $orderPages
            ]
        );
    }
}
