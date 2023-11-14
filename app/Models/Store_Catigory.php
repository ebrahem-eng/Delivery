<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store_Catigory extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'catigory_id',
    ];

    public function catigory()
    {
        return $this->belongsTo(Catigory::class, 'catigory_id');
    }

    public function catigory_store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
