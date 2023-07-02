<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $cart = DB::table('carts')->get()->first();
        // // 如果購物車為空
        // if(empty($cart)) {
        //     DB::table('carts')->insert(['created_at'=> now(),'updated_at'=> now()]);
        //     $cart = DB::table('carts')->get()->first();
        // }
        // $cartItems = DB::table('cart_items')->where('cart_id', $cart->id)->get();
        // $cart = collect($cart);
        // $cart['item'] = collect($cartItems);

        // 通過驗的會員
        $user = auth()->user();

        // 判斷Cart是否有資料，firstOrCreate沒有則新增，有則回傳會員資料where('user_id',$user->id)
        $cart = Cart::with(['cartItems'])
        ->where('user_id' , $user->id)
        ->firstOrCreate(['user_id' => $user->id]);
        return response($cart);
    }

    public function checkout() 
    {
        // 1.找使用者
        $user = auth() -> user();
        // 2.找到使用者購物車-未結帳的第一筆資料
        $cart = $user->carts()->where('checkouted', false)->with('cartItems')->first();
        // 3.如果有購物車有資料，確認是否有結帳
        if($cart) {
            $result = $cart->checkout();
            return response($result);
        }else{
            // 3.沒有購物車
            return response('沒有購物車' ,400);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
