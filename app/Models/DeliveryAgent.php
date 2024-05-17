<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class DeliveryAgent extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable , SoftDeletes;


    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'created_by',
        'status',
        'status_accept_order',
        'age',
        'phone',
        'img',
        'deliveryAgentLocationID',

    ];

    //علاقة المدير مع عامل التوصيل

    public function admin()
    {
        return $this->belongsTo(Admin::class , 'created_by');
    }

    //  //علاقة عامل التوصيل مع تفاصيل الطلب

    //  public function orderDetailsAgents()
    //  {
    //      return $this->hasMany(Order_Details::class,'delivered_by');
    //  }


     //علاقة عامل التوصيل مع موقع عامل التوصيل 

     public function deliveryAgentLocation()
     {
         return $this->belongsTo(DeliveryAgentLocation::class , 'deliveryAgentID');
     }

      //علاقة عامل التوصيل مع الطلب

      public function deliverOrder()
      {
          return $this->hasMany(DeliveryAgentOrder::class,'deliveryAgentID');
      }
    

      public function sentMessages()
      {
          return $this->hasMany(Message::class, 'sender_id');
      }
  
      public function receivedMessages()
      {
          return $this->hasMany(Message::class, 'receiver_id');
      }
      
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }   
}
