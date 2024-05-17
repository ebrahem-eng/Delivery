<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
        'is_sent_by_user',
    ];

    public function sender()
    {
        return $this->belongsTo(UserD::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(UserD::class, 'receiver_id');
    }
}
