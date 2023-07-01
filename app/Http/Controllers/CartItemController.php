<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateCartItem;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('cart_items')->get();
        return response($data);
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
        $messages = [
            'required' => ':attribute 是必要的',
            'between' => ':attribute 是輸入 :input 不在 :min 和 :max 之間',
        ];
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|between:1,10'
        ], $messages);
        // 驗證失敗
        if($validator -> fails()) {
            return response($validator->errors(), 400);
        };
        $validatedData = $validator->validate();
        $cart = Cart::find($validatedData['cart_id']);
        $result = $cart->cartItems()->create([
            'product_id' => $validatedData['product_id'],
                'quantity' => $validatedData['quantity'],
        ]);
        
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function show(CartItem $cartItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function edit(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCartItem $request, $id)
    {
        $form = $request->validated();
        $item = CartItem::find($id);
        //先填充，未儲存
        $item -> fill(['quantity' => $form['quantity']]);
        $item->save();
        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = CartItem::find($id)->delete();
        return response()->json(true);
    }
}
