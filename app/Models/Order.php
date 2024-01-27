<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [

        'order_status',
        'reason_of_refuse',
        'type',
        'store_accept_status',
        'delivery_accept_status',
        'delivered_code',
        'receipt_code',
        'order_note',
        'deliveryFee',
        'typePayment',
        'deliveryTips',
        'voucher',
        'tax',
        'totalAmmount',
        'deliveredBy',
        'deliveredPhone',
        'user_location_id',
        'store_id',
        'user_id',
    ];

    //علاقة الطلب مع تفاصيل الطلب

    public function orderDetails()
    {
        return $this->hasMany(Order_Details::class, 'order_id');
    }

    //علاقة الطلب مع موقع المستخدم

    public function userLocation()
    {
        return $this->belongsTo(UserD_Location::class, 'user_location_id');
    }

    //علاقة الطلب مع المستخدم

    public function user()
    {
        return $this->belongsTo(UserD::class, 'user_id');
    }

    //علاقة الطلب مع المتجر

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    //علاقة الطلب مع كود الحسم

    public function discountCode()
    {
        return $this->hasMany(DiscountCode_Order::class, 'order_id');
    }

      //علاقة الطلب مع طلبات عامل التوصيل

      public function deliveryAgentOrder()
      {
          return $this->hasMany(DeliveryAgentOrder::class, 'orderID');
      }
}
