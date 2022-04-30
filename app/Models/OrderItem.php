<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'qty',
        'price',
        'profit',
    ];

    protected $with = ['item'];

    public function selling()
    {
        return $this->belongsTo(Selling::class);
    }

    public function price()
    {
        return number_format($this->selling_price);
    }

    public function total()
    {
        return number_format($this->amount());
    }

    public function amount()
    {
        return $this->selling_price*$this->qty;
    }



    public function date()
    {
        return Date::parse($this->created_at)->format('d-m-Y H:i');
    }



    public function user()
    {
        return $this->selling->user->name??"";
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
