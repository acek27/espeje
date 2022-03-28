<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Uraian extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'kode_rek',
        'sub_id',
        'nama_uraian',
        'jumlah',
        'status',
    ];

    public static $rulesCreate = [
        'kode_rek' => 'required|unique:uraians|max:25',
        'nama_uraian' => 'required',
        'jumlah' => 'numeric|required',
        'status' => 'required'
    ];

    public static function rulesEdit(Uraian $data)
    {
        return [
            'kode_rek' => 'required|max:25',
            'nama_uraian' => 'required',
            'jumlah' => 'numeric|required',
            'status' => 'required'
        ];
    }


    protected function namaUraian(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucfirst($value),
        );
    }

    public function subkegiatan()
    {
        return $this->belongsTo(Subkegiatan::class, 'sub_id', 'kode_rek');
    }
}
