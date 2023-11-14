<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Catigory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'catigory_id'
    ];

    public function catigory()
    {
        return $this->belongsTo(Catigory::class, 'catigory_id');
    }

    public function catigory_product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
}
