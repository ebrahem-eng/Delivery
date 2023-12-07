<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Details extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_price',
        'product_note',
        'quantity',
        'productTotalAmount',
        // 'delivery_amount',
        // 'discount_amount',
        // 'delivered_by',
        'product_id',
        // 'discount_code_id',
        'order_id',
    ];

    //علاقة تفاصيل الطلب مع الطلب

      public function order()
      
         {
        return $this->belongsTo(Order::class , 'order_id');
         }


        //   //علاقة تفاصيل الطلب مع كود الحسم

        //   public function discountCodeOrder()
        //   {
        //       return $this->belongsTo(DiscountCode::class , 'discount_code_id');
        //   }

            //علاقة تفاصيل الطلب مع المنتجات

            public function productOrderDetails()
            {
                return $this->belongsTo(product::class , 'product_id');
            }

             //علاقة تفاصيل الطلب مع عمال التوصيل

             public function DeliveryAgentOrder()
             {
                 return $this->belongsTo(DeliveryAgent::class , 'delivered_by');
             }
}
