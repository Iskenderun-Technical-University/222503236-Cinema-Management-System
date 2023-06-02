<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use function Pest\Laravel\get;

class Session extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function cinema(): BelongsTo
    {
        return $this->belongsTo(Cinema::class);
    }

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    protected $appends = ['is_completed'];//boyle bir sanal column olustur ve buna user orneginden ulas
    public function getIsCompletedAttribute(): bool
    {
        /**
         *
         * once date ve time ile bir tarih olusutracagim
         * sonra anlik zamandan onun farkina bakacagim
         * eger fark pozitf ise true donecegim
         * negatif ise false donecegim
         */
        if (Carbon::now()->diffInMinutes(Carbon::createFromFormat('Y-m-d H:m:s', $this->date . ' ' . $this->time))) {
            return true;
        }
        return false;
    }
}
