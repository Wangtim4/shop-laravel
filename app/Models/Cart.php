<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // 所有欄位都可新增資料
    protected $guarded = [''];
    
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
        //  當carts執行checkout時，建立order
        $order = $this->order()->create([
            // order的user_id = 本身model的Cart自己的user_id
            'user_id'=>$this->user_id
        ]);
        foreach($this->cartItems as $cartItem) {
            $order->orderItems()->create([
                'product_id' => $cartItem->product_id,
                'price' => $cartItem->product->price,
            ]);
        }
        $this->update(['checkouted' => true]);
        $order->orderItems;
        return $order;
    }
}
