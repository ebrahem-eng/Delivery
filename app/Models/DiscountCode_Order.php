<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode_Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'discountCode_id',
        'discountValue',
    ];

    //  علاقة الطلب مع كود الحسم

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    //علاقة كود الحسم مع الطلب
    public function discountCode()
    {
        return $this->belongsTo(DiscountCode::class, 'discountCode_id');
    }
}
