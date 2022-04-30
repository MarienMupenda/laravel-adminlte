<?php

namespace App\Models;

use App\DataTables\UnitTable;
use App\Traits\HasLaTable;
use Illuminate\Database\Eloquent\Model;
use Lakasir\UserLoggingActivity\Traits\HasLog;

class Unit extends Model
{
    protected $hidden = ["created_at", "updated_at"];
    protected $fillable = ['name'];
}
