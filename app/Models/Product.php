<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded=[''];

    public function cartItems() {
        return $this->hasMany(CartItem::class);
    }
    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }
    // 驗證庫存數量是否足夠
    public function checkQuantity($quantity) {
        if($this -> quantity < $quantity) {
            return false;
        }
        return true;
    }
}
