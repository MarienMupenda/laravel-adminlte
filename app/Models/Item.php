<?php

namespace App\Models;

use App\DataTables\ItemTable;
use App\Traits\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasLaTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Item extends Model
{

    use HasFactory;

    public const STATE_PUBLISHED = 'published';
    const STATE_DRAFT = 'draft';

    protected $hidden = [
        "created_at",
        'updated_at',
        //"company_id",
        "category_id", "user_id", "unit_id",
    ];

    protected $fillable = [
        'name',
        'image',
        'category_id',
        'unit_id',
        'company_id',
        'description',
        'selling_price'

    ];
    //->with('unit', 'category', 'company', 'promotions')->first()

    //protected $with = ['company'];

    public function qty()
    {
        $stock = $this->stock;
        $selling = $this->sellings_qty();

        $qty = $stock - $selling;

        return $qty < 0 ? 0 : $qty;
    }

    public function articles()
    {
        return $this->hasMany(Article::class)->orderBy('color_id', 'asc');
    }

    public function company()
    {
        return $this->belongsTo(Company::class)->with('currency');
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function sellings_qty()
    {
        $qty = 0;
        foreach ($this->sellingDetails as $detail) {
            $qty += $detail->qty;
        }
        return $qty;
    }

    public function soldQty()
    {

        return $this->sellings_qty();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCurrency()
    {
        return $this->company->currency->symbol;
    }

    public function sellingDetails()
    {
        return $this->hasMany(SellingDetail::class);
    }


    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class, 'item_id');
    }

    public function priceWithCurrency()
    {
        return number_format($this->selling_price, 1, ',', '.') . $this->company->currency_symbol();
    }

    public function price()
    {
        return number_format($this->selling_price, 1, ',', '.');
    }


    public function status()
    {
        return $this->state();
    }

    public function visits()
    {
        return visits($this)->count();
    }

    public function log_stocks()
    {
        return $this->hasMany(Stock::class, 'item_id')->orderBy('date', 'asc');
    }

    public function getStockAttribute()
    {
        return $this->log_stocks()->sum('qty');
    }


    public function getLastStockAttribute()
    {
        return Stock::where('qty', '>', 0)->where('item_id', $this->id)->orderBy('date', 'asc')->first();
    }

    public function getLastSellingAttribute()
    {
        return Stock::where('qty', '>', 0)->where('item_id', $this->id)->orderBy('date', 'asc')->first();
    }

    public function getLastPriceAttribute()
    {
        $stockPrice = optional($this->last_stock)->price;
        if (!$stockPrice) {
            if ($this->prices->last()) {
                return $this->prices->last();
            } else {
                return (object)[
                    'initial_price' => 0,
                    'selling_price' => 0
                ];
            }
        }

        return $stockPrice;
    }

    public function getPriceXQtyAttribute()
    {
        return $this->sellingDetails->sum('price') * $this->sellingDetails->sum('qty');
    }




    public function state()
    {
        if ((($this->state = self::STATE_PUBLISHED) && !$this->image()) || ($this->company->state == Company::STATE_PENDING)) {
            $this->state = self::STATE_DRAFT;
            $this->update();
        }
        if (($this->state = self::STATE_DRAFT) && $this->image()) {
            $this->state = self::STATE_PUBLISHED;
            $this->update();
        }

        return $this->state;
    }

    public function image()
    {
        if (!empty($this->image)) {
            $file = 'storage/companies/' . $this->company_id . '/items/' . $this->image;
            if (file_exists($file)) {
                return asset($file);
            }
        }
        //return $this->company->logo();
        return null;
    }

    public function thumbnail()
    {
        return $this->image_small();
    }

    public function imageSmall()
    {
        return $this->image_small();
    }

    public function title()
    {
        return  $this->name . ' - ' . $this->selling_price . ' ' . $this->company->currency->symbol . ' | ' . $this->company->name;
    }


    public function image_small()
    {
        if (!empty($this->image)) {
            $original = 'storage/companies/' . $this->company_id . '/items/' . $this->image;
            $small = 'storage/companies/' . $this->company_id . '/items/small/' . $this->image;

            if (file_exists($small)) {
                return asset($small);
            }

            if (file_exists($original)) {
                //Create thumbnail

                $thumbnail = Image::make($original);
                $thumbnail->resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $thumbnail->stream();
                //store thumbnail
                $created = Storage::put('public/companies/' . $this->company_id . '/items/small/' . $this->image, $thumbnail);
                if ($created) {
                    return $this->image_small();
                }
            }
        }
        return $this->company->logo();
        // return null;
    }

    public function delete_image()
    {
        if (!empty($this->image)) {

            $file1 = 'public/companies/' . $this->company_id . '/items/small/' . $this->image;
            $file2 = 'public/companies/' . $this->company_id . '/items/' . $this->image;

            return Storage::delete([$file1, $file2]);
        }
    }

    function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    public function delete(): ?bool
    {
        $this->delete_image();
        return parent::delete(); // TODO: Change the autogenerated stub
    }
}