<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserD_Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location_id',
    ];


    //علاقة موقع المستخدم مع الطلبات

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_location_id');
    }

    //علاقة موقع المستخدم مع الموقع

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    //علاقة موقع المستخدم مع المستخدم

    public function user()
    {
        return $this->belongsTo(UserD::class, 'user_id');
    }
}
