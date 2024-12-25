<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'branch_id',
        'price',
        'quantity'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }
}
