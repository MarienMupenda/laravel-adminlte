<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $hidden = ["created_at", "updated_at", 'company_id'];
    protected $fillable = [
        'company_id',
        'whatsapp',
        'facebook',
        'email',
        'linkedin',
        'website',
        'twitter'

    ];
}
