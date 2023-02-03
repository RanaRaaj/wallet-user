<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_types','name','address','order_id','item','unit_price','quantity','unit_price2','quantity2','unit_price3','quantity3','unit_price4','quantity4','zip_code','email','tracking_id','shipping_method','shipping','date','note','status','slip_id','after_note'
    ];
}
