<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasLaTable;

class Category extends Model
{

    protected $hidden = ["created_at", "updated_at","company_id"];

    protected $fillable = ['name','icon'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
