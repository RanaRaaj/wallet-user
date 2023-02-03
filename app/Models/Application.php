<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'r_first_name','r_last_name','first_name','last_name','email','r_email','dob','phone_no','attachment','resume','portfolio','status','job_id'
    ];
}
