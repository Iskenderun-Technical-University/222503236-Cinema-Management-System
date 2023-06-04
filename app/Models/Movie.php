<?php

namespace App\Models;

use App\Trait\BaseModelTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory , BaseModelTrait;

    protected $guarded = [];


    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => ucfirst($value),
        );
    }

    protected function genre(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => ucfirst($value),
        );
    }

    protected function director(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => ucfirst($value),
        );
    }
}
