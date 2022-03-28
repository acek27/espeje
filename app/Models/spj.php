<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class spj extends Model
{
    public function uraian()
    {
        return $this->belongsTo(Uraian::class, 'uraian_id', 'kode_rek');
    }
}
