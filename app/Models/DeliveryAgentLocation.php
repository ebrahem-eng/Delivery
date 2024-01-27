<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAgentLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'longitudeStart',
        'longitudeEnd',
        'latitudeStart',
        'latitudeEnd',
    ];

      //علاقة موقع عامل التوصيل مع عامل التوصيل

      public function deliveryAgent()
      {
          return $this->hasMany(DeliveryAgent::class , 'deliveryAgentID');
      }

}
