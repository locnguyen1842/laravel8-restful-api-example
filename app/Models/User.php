<?php

namespace App\Models;

use App\Traits\ModelFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use libphonenumber\PhoneNumberFormat;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, ModelFilterTrait, SoftDeletes, HasRoles;

    protected $guard_name = 'api';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function findForPassport($username)
    {
        return self::where('phone_number', $username)->first();
    }

    public function getNationalPhoneNumberAttribute()
    {
        return str_replace(' ', '', phone_number($this->phone_number, PhoneNumberFormat::NATIONAL));
    }

    public function getParsedPhoneNumberAttribute()
    {
        return phone_number($this->phone_number);
    }

    public function isAdmin()
    {
        if($this->hasRole('admin')) {
            return true;
        }

        return false;
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function posts()
    {
        return $this->hasMany(\App\Models\Post::class);
    }
    
    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }
}
