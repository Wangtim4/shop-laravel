<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // 所有欄位都可新增資料
    protected $guarded = [''];
    // 會員等級影響消費折扣
    private $rate = 1;
    
    public function cartItems() {
        return $this->hasMany(CartItem::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function order() {
        // 一個cart只有一個order
        return $this->hasOne(Order::class);
    }

    public function checkout() {
        foreach($this->cartItems as $cartItem) {
            $product = $cartItem->product;
            // 判斷庫存是否不足
            if(!$product->checkQuantity($cartItem->quantity)){
                return $product->title.'數量不足';
            }
        }
        //  當carts執行checkout時，建立order
        $order = $this->order()->create([
            // order的user_id = 本身model的Cart自己的user_id
            'user_id'=>$this->user_id
        ]);
        // 判斷會員等級，消費折扣
        if($this->user->level == 2 ) {
            $this -> rate = 0.8;
        }

        foreach($this->cartItems as $cartItem) {
            $order->orderItems()->create([
                'product_id' => $cartItem->product_id,
                // 判斷會員等級，消費折扣 price * $this -> rate
                'price' => $cartItem->product->price * $this -> rate,
            ]);
            // 更新產品庫存數量
            $cartItem->product->update(['quantity' => $cartItem->product->quantity - $cartItem->quantity]);
        }
        $this->update(['checkouted' => true]);
        $order->orderItems;
        return $order;
    }
}
