<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Uraian extends Model
{
    use SoftDeletes;

    protected function namaUraian(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucfirst($value),
        );
    }
}
