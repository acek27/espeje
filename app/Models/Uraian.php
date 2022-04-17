<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Uraian extends Model
{
    use SoftDeletes;

    protected $with = ['subkegiatan'];
    protected $appends = ['rat', 'sisa', 'used'];
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

    public function getRatAttribute()
    {
        return " Rp. " . number_format($this->jumlah, 0, ",", ".");
    }

    protected function namaUraian(): Attribute
    {
        return Attribute::make(
            set: fn($value) => ucfirst($value),
        );
    }

    public function subkegiatan()
    {
        return $this->belongsTo(Subkegiatan::class, 'sub_id', 'kode_rek');
    }

    public function spj()
    {
        return $this->hasMany(Spj::class, 'uraian_id', 'kode_rek');
    }

    public function getSisaAttribute()
    {
        $used = $this->spj->sum('jumlah');
        return " Rp. " . number_format($this->jumlah - $used, 0, ",", ".");
    }

    public function getUsedAttribute()
    {
        return $this->spj->count();
    }
}
