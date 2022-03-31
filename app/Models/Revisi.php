<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Revisi extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $with = ['validator'];
    protected $attributes = ['status' => 0];
    protected $appends = ['state'];

    public function getStateAttribute()
    {
        $status = "";
        if ($this->status == 0) {
            $status = "Proses perbaikan";
        } elseif ($this->status == 1) {
            $status = "Menunggu verifikasi";
        } else {
            $status = "Selesai";
        }
        return $status;
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validator_id', 'id');
    }

}
