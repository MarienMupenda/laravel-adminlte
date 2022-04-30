<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasLaTable;

class Supplier extends Model
{


    protected $fillable = [
        'name',
        'shop_name',
        'name',
        'phone',
        'address',
        'code'
    ];

    public function purchasings()
    {
        return $this->hasMany(Purchasing::class, 'supplier_id');
    }
}
