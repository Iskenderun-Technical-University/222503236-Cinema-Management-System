<?php

namespace App\Models;

use App\Trait\BaseModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seat extends Model
{
    use HasFactory , BaseModelTrait;

    protected $guarded = [];

    public function cinema(): BelongsTo
    {
        return $this->belongsTo(Cinema::class);
       // return $this->belongsTo(Cinema::class, "cinema_id", "id");
    }

}
