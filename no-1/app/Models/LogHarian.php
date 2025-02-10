<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

class LogHarian extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'deskripsi',
        'status',
        'verified_at',
    ];

    protected $dates = ['verified_at'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
