<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cicilan extends Model
{
    protected $table = 'cicilans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'penjualan_id',
        'jumlah_per_cicilan',
        'total_cicilan',
        'sisa_cicilan',
        'status',
        'date'
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }

    public function pembayaran_cicilans()
    {
        return $this->hasMany(Cicilan::class);
    }
}
