<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spj extends Model
{
    use SoftDeletes;

    protected $fillable = ['uraian_id', 'jumlah', 'status'];
    protected $with = ['uraian', 'revisi'];
    protected $attributes = [
        'status' => 0
    ];

    public static $rulesCreate = [
        'uraian_id' => 'required',
        'jumlah' => 'numeric|required',
    ];

    public static function rulesEdit(Spj $data)
    {
        return [
            'uraian_id' => 'required',
            'jumlah' => 'numeric|required',
        ];
    }

    public function uraian()
    {
        return $this->belongsTo(Uraian::class, 'uraian_id', 'kode_rek');
    }

    public function revisi()
    {
        return $this->hasMany(Revisi::class, 'spj_id', 'id');
    }
}
