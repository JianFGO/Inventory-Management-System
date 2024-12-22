<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_no','branch_id','total_amount','paid_amount','delivery_date'
    ];
    // Defines foreign key relationships
    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }
    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetails');
    }
}
