<?php

namespace App\Models;


use App\Helpers\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Date\Date;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{


    use HasFactory, Notifiable, HasRoles;

    public const PROFILE_DIR = 'public/users';
    public const PROFILE_DIR_PUCLIC = 'storage/users';
    public const ADMIN = 2;
    public const SUPER_ADMIN = 1;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'company_id', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'company_id', 'role_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getCreatedAtAttribute($value)
    {
        return Date::parse($value)->format('d/m/Y');
    }

    public function isAdmin()
    {
        return $this->role_id == self::ADMIN or $this->role_id == self::ADMIN;
    }

    public function isSuperAdmin()
    {
        return $this->role_id == self::SUPER_ADMIN;
    }


    public function adminlte_image()
    {
        return $this->image();
    }

    public function image()
    {
        if (isset($this->image)) {
            $file = Helpers::profile_image_public($this->image);
            if (file_exists($file)) {
                return asset($file);
            }
        }
        if ($this->company)
            return $this->company->logo();

        return asset('images/icons/logo.png');
    }

    public function adminlte_desc()
    {
        return $this->roles->first()->name??'N/A';
    }

    public function adminlte_profile_url()
    {
        return "/users/$this->id/edit";
    }

    /**
     * check is Owner
     *
     * @return bool
     */
    public function getIsOwnerAttribute(): bool
    {
        return $this->getRoleNames()->first() == 'owner';
    }

    public
    function delete_image()
    {
        if (!empty($this->image)) {
            //  $file = 'public/companies/' .$this->company_id . '/users/' . $this->image;
            $file = Helpers::profile_image($this->image);
            return Storage::delete($file);
        }
    }
}
