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
}
