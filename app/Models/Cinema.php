<?php

namespace App\Models;

use App\Trait\BaseModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Cinema extends Model
{
    use HasFactory , BaseModelTrait;
    protected $guarded = [];


    /**
     * @return HasMany
     * bu iliski bize sorgu sirasinda cinema tablosunun sahip oldugu koltuklarla beraber gelmesini saglar
     */
    public function seats(): HasMany // relationship
    {
        return $this->hasMany(Seat::class);
    }


}
