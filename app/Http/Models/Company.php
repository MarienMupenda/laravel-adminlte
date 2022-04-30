<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Jenssegers\Date\Date;

class Company extends Model
{
    use softDeletes;

    public const STATE_ACTIVE = 'active';
    public const STATE_PENDING = 'pending';
    public const MESSAGE_NOT_ACTIVE = "Votre entreprise n'est pas activée, votre accès se limite à ajouter, modifier, supprimer et cataloguer vos produits. Merci de nous <a href='https://wa.me/243970966587?text=Bonjour Uzaraka,'>contacter</a> en vue de l'activation gratuite";
    protected $hidden = ["created_at", "updated_at", 'currency_id', 'business_id'];


    protected $fillable = [
        'name',
        'business_id',
        'description',
        'address',
        'currency_id',
        'logo',
        'rccm',
        'idnat',
        'user_id',
        'state',
    ];

    //protected $with = ['contact', 'currency'];

    /**
     * user relation
     *
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }


    public function createdAt()
    {
        return Date::parse($this->created_at)->format('d-m-Y H:i');
    }

    public function visits()
    {
        return visits($this)->relation();
    }

    public function sellings(): HasMany
    {
        return $this->hasMany(Selling::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function getBusinessName()
    {
        if ($this->business)
            return $this->business->name;
    }

    public function getWhatsapp()
    {
        if ($this->contact)
            return Str::replaceFirst('+', '', $this->contact->whatsapp);
    }

    public function currency_symbol()
    {
        return $this->currency->symbol;
    }

    function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    function contact(): HasOne
    {
        return $this->hasOne(Contact::class);
    }

    function whatsapp()
    {
        return $this->contact->whatsapp ?? "243970966587";
    }

    function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function logo(): string
    {
        if (!empty($this->logo)) {
            $file = 'storage/companies/' . $this->id . '/' . $this->logo;
            if (file_exists($file)) {
                return asset($file);
            }
        }
        return asset('images/icons/logo.png');
    }

    public function delete_logo()
    {
        if (!empty($this->image)) {
            $file = 'public/companies/' . $this->id . '/' . $this->logo;
            return Storage::delete($file);
        }
    }
}
