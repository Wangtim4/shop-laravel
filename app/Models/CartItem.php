<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    // 白名單，只有那些可以更新
    // protected $fillable = ['quantity'];
    
    // 黑名單
    protected $guarded = ['']; //參數皆可改

    // 隱藏欄位
    // protected $hidden = ['updated_at'];
    // 新增欄位
    protected $appends = ['current_price'];
    // 設定current_price
    public function getCurrentPriceAttribute() {
        return $this->quantity * 10 ;
    }

    // belongsTo  單筆資料
    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function cart() {
        return $this->belongsTo(Cart::class);
    }
}
