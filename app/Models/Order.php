<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // 所有欄位都可新增資料
    protected $guarded = [''];
    
    public function orderItems() {
        return $this->hasMany(orderItem::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function cart() {
        return $this->belongsTo(Cart::class);
    }
}
