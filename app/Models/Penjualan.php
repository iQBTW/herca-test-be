<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualans';
    protected $primaryKey = 'id';
    public function marketing()
    {
        return $this->belongsTo(Marketing::class);
    }
}
