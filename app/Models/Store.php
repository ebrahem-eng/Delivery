<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Store extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard = 'store';
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'status',
        'phone',
        'img',
        'openTime',
        'closeTime',
        'created_by',
        'location_id'

    ];
    //علاقة المتجر مع المسؤولين

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    //علاقة المتجر مع المنتجات

    public function products()
    {
        return $this->hasMany(product::class, 'store_id');
    }

    //علاقة المتجر مع التصنيف

    public function store_catigory()
    {
        return $this->hasMany(Store_Catigory::class, 'store_id');
    }


    //علاقة المتجر مع الطلبات

    public function orders()
    {
        return $this->hasMany(Order::class, 'store_id');
    }

     //علاقة المتجر مع الموقع

     public function location()
     {
         return $this->belongsTo(Location::class, 'location_id');
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
