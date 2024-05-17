<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserD extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'status',
        'city',
        'age',
        'phone',
        'img',
    ];

    //علاقة المستخدم مع الطلبات

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }


    //

    // public function locations()
    // {
    //     return $this->belongsToMany(Location::class, 'user_d__locations', 'user_id', 'location_id');
    // }

 
    //علاقة المستخدم مع الموقع

      public function locations()
      {
          return $this->hasMany(UserD_Location::class, 'user_id');
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
