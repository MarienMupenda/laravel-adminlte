<?php

namespace App\Models;

use App\Traits\HasLaTable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $hidden = ["created_at", "updated_at", "company_id"];

    protected $fillable = ['name', 'icon'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    // create children relationship
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
