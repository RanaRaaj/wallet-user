<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','long_description','short_description','job_description','requirement','file','tags','job_types','location','job_category','job_time','job_product_group','status'
    ];
}
