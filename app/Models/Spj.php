<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spj extends Model
{
    use SoftDeletes;

    protected $fillable = ['uraian_id', 'pptk_id', 'jumlah', 'status'];
    protected $with = ['uraian', 'revisi','pptk'];
    protected $appends = ['state'];
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

    public function getStateAttribute()
    {
        $a = '';
        if ($this->status == 0) {
            $a = 'Diajukan';
        } elseif ($this->status == 1) {
            $a = 'Revisi';
        } elseif ($this->status == 2) {
            $a = 'Disetujui PU';
        } elseif ($this->status == 3) {
            $a = 'Disetujui LS/GU';
        } else {
            $a = 'Selesai';
        }
        return $a;
    }

    public function uraian()
    {
        return $this->belongsTo(Uraian::class, 'uraian_id', 'kode_rek');
    }

    public function pptk()
    {
        return $this->belongsTo(User::class, 'pptk_id', 'id');
    }

    public function revisi()
    {
        return $this->hasMany(Revisi::class, 'spj_id', 'id');
    }
}
