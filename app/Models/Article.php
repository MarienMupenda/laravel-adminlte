<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $with = ['color','size'];
    protected $hidden = ["created_at", "updated_at",'item_id','size_id','color_id'];


    function color()
    {
        return $this->belongsTo(Color::class);
    }

    function size()
    {
        return $this->belongsTo(Size::class);
    }


    function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function qty()
    {
        $stock = $this->stock;
        $selling = $this->sellings();

       return $stock - $selling;
       // return $selling;
    }

    public function getStockAttribute()
    {
        return $this->log_stocks()->sum('qty');
    }

    public function log_stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function getLastStockAttribute()
    {
        return Stock::where('qty', '>', 0)->where('article_id', $this->id)->orderBy('date', 'asc')->first();
    }

    public function sellings()
    {
        $qty = 0;
        foreach ($this->sellingDetails as $detail) {
            $qty += $detail->qty;
        }
        return $qty;
    }

    public function sellingDetails()
    {
        return $this->hasMany(SellingDetail::class);
    }
}
