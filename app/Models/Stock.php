<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'qty',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }


    public function price()
    {
        return $this->belongsTo(Price::class);
    }

    public function stock()
    {
        return 0;
    }

}
