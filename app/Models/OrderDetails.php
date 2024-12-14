<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $fillable = [
        'order_id','category_id','product_id','order_quantity','unit_price'
    ];
}
