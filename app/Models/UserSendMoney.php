<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSendMoney extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'sender_name',
        'receiver_id',
        'receiver_name',
        'amount',
        'status',
    ];
}
