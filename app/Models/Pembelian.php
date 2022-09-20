<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function catatanBeli()
    {
        return $this->belongsTo(CatatanBeli::class);
    }
}
