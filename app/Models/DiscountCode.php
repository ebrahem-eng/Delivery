<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountCode extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'code_name',
        'discount_value',
        'status',
        'created_by',
    ];

    //علاقة كود الحسم مع المدير

    public function admin()
    {
        return $this->belongsTo(Admin::class , 'created_by');
    }


    //  //علاقة كود الحسم مع تفاصيل الطلب

    //  public function orderDetailsCode()
    //  {
    //      return $this->hasMany(Order_Details::class,'discount_code_id');
    //  }

    
     //علاقة كود الحسم مع الطلب

    public function orderDiscountCode()
    {
        return $this->hasMany(DiscountCode_Order::class,'discountCode_id');
    }
    

}
