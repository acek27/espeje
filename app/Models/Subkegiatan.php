<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subkegiatan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'kode_rek',
        'nama_sub',
        'status',
    ];

    public static $rulesCreate = [
        'kode_rek' => 'required|unique:subkegiatans|max:25',
        'nama_sub' => 'required',
        'status' => 'required'
    ];

    public static function rulesEdit(Subkegiatan $data)
    {
        return [
            'kode_rek' => 'required|max:25',
            'nama_sub' => 'required',
            'status' => 'required'
        ];
    }

    protected function namaSub(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucfirst($value),
        );
    }
}
