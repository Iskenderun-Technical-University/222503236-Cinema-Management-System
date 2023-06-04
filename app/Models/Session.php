<?php

namespace App\Models;

use App\Trait\BaseModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use function Pest\Laravel\get;

class Session extends Model
{
    use HasFactory , BaseModelTrait;

    protected $guarded = [];

    protected $appends = ['is_completed', 'total', 'available', 'seat_rate'];//boyle bir sanal column olustur ve buna user orneginden ulas


    public function session_seat(): HasMany
    {
        return $this->hasMany(SessionSeat::class);
    }


    public function cinema(): BelongsTo
    {
        return $this->belongsTo(Cinema::class);
    }

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }


    public function getTotalAttribute()
    {
        return $this->hasMany(SessionSeat::class)->count();
    }

    public function getAvailableAttribute()
    {
        return $this->hasMany(SessionSeat::class)
            ->where('seat_status', '=', 'available')
            ->count();
    }
    public function getSeatRateAttribute()
    {
        return ($this->total-$this->available)/$this->total*100;
    }

    public function getIsCompletedAttribute(): string
    {
        /**
         *
         * once date ve time ile bir tarih olusutracagim
         * sonra anlik zamandan onun farkina bakacagim
         * eger fark pozitf ise true donecegim
         * negatif ise false donecegim
         */


        return $diff = Carbon::parse($this->date . ' ' . $this->time)->diffInMinutes(Carbon::now(), false);
        //   dun - simdiki zaman == - deger verir

    }
}
