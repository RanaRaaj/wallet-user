<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDeposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',
        'bank_name',
        'account_name',
        'account_number',
        'amount',
        'file',
    ];
}
