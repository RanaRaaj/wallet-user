<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stoke extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_code','product_name','type','quantity','balance','order_id','place','price','status'
    ];
}
