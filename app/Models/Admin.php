<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard = 'admin';
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'type',
        'status',
        'age',
        'phone',
        'img',

    ];

    //علاقة المدير مع المتاجر

    public function stores()
    {
        return $this->hasMany(Store::class,'created_by');
    }

     //علاقة المدير مع عمال التوصيل

    public function deliveryAgents()
    {
        return $this->hasMany(DeliveryAgent::class,'created_by');
    }

     //علاقة المدير مع اكواد الخصم
     
    public function discountCodes()
    {
        return $this->hasMany(DiscountCode::class,'created_by');
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
}
