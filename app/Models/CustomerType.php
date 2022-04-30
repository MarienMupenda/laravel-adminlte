<?php

namespace App\Models;

use App\Traits\HasLaTable;
use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{


    protected $fillable = [
        'default_point',
        'name'
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

}
