<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function catatanBeli()
    {
        return $this->belongsTo(CatatanBeli::class, 'id_catatanBeli');
    }
}
