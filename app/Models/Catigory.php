<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catigory extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = [
        'name',
        'type',
    ];


    //علاقة التصنيف مع المتاجر

    public function store_catigory()
    {
        return $this->hasMany(Store_Catigory::class, 'catigory_id');
    }


    //علاقة التصنيف مع المنتجات

    public function product_catigory()
    {
        return $this->hasMany(Product_Catigory::class, 'catigory_id');
    }
}
