<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index() 
    {
        $products = Product::all();
        // view(顯示頁面,傳入資料)
        return view('web.index', ['products' => $products]);
    }

    public function contactUs()
    {
        return view('web.contact_us');
    }
}
