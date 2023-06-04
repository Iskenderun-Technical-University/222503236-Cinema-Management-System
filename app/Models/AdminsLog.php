<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminsLog extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $appends = ['full_name'];//boyle bir sanal column olustur ve buna user orneginden ulas


    public function getFullNameAttribute()
    {
        if ($this->user) {
            return $this->user->first_name . ' ' . $this->user->last_name;
        }
        return null; // İlişkili User modeli bulunamadığında nasıl bir değer döndürmek istediğinize bağlı olarak null veya başka bir değer döndürebilirsiniz.
    }

}
