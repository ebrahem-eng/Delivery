<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'details',
        'status',
        'img',
        'store_id',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }


    //علاقة المنتج مع التصنيف

    public function product_catigory()
    {
        return $this->hasMany(Product_Catigory::class, 'product_id');
    }

    //علاقة المنتجات مع تفاصيل الطلب

    public function orderDetailsproduct()
    {
        return $this->hasMany(Order_Details::class, 'product_id');
    }
}
