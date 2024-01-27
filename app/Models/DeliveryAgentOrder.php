<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAgentOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'details',
        'status',
        'expectedDeliveryTime',
        'realDeliveryTime',
        'orderID',
        'deliveryAgentID',

    ];


    //علاقة طلبات عامل التوصيل مع عامل التوصيل

    public function deliveryAgent()
    {
        return $this->belongsTo(DeliveryAgent::class, 'deliveryAgentID');
    }

       //علاقة طلبات عامل التوصيل مع عامل الطلبات

    public function order()
    {
        return $this->belongsTo(Order::class, 'orderID');
    }
}
