<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranCicilan extends Model
{
    protected $table = 'pembayaran_cicilans';
    protected $primaryKey = 'id';
    protected $fillable = ['cicilan_id', 'jumlah_pembayaran', 'date'];

    public function cicilan()
    {
        return $this->belongsTo(Cicilan::class);
    }
}
