<?php

namespace App\Models;

use App\Trait\BaseModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory , BaseModelTrait;

    protected $guarded = [];


}
