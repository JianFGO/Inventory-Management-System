<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable = [
        'branch_id',
        'full_name',
        'email',
        'username',
        'password',
        'role'
    ];

    // Defines foreign key relationship
    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }
}
