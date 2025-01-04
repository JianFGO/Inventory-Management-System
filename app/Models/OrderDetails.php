<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class OrderDetails extends Model
{
    use HasFactory;
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
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}

