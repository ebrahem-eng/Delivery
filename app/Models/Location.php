<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'area',
        'street',
        'floor',
        'near',
        'another_details',
        'longitude',
        'latitude',
    ];

    //علاقة الموقع مع المستخدم

    // public function users()
    // {
    //     return $this->belongsToMany(UserD::class, 'user_d__locations', 'location_id', 'user_id');
    // }


      //علاقة الموقع مع المستخدمين

      public function users()
      {
          return $this->hasMany(UserD_Location::class, 'location_id');
      }

      //علاقة الموقع مع المتاجر

      public function stores()
      {
          return $this->hasMany(Store::class, 'location_id');
      }
}
