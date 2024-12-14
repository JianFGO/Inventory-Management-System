<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_no','branch_id','total_products','paid_amount','delivery_date'
    ];
}
