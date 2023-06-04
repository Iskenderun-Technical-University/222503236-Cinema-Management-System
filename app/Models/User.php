<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Trait\BaseModelTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable   , BaseModelTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'date_of_birth',
        'password',
    ];

    //  protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** @var string[] burda once bir attribute tanimladik sonra ise bu attributenin degerini belirledik */

    protected $appends = ['full_isim','full_name'];//boyle bir sanal column olustur ve buna user orneginden ulas

    public function getFullIsimAttribute(): string// burda olusturdugun full_name attribute icin deger belirle
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }


    /**
     * Get the user's first name.
     * mevcut bir qattribute uzerinde degisiklik yapmami saglar onu goruntulerken
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function firstName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value),
        );
    }


}
