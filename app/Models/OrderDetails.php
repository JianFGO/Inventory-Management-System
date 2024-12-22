<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $fillable = [
        'order_id','category_id','product_id','order_quantity','unit_price'
    ];

    // Defines foreign key relationships
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}

