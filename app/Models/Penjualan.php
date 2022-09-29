<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function catatanJual()
    {
        return $this->belongsTo(CatatanJual::class, 'id_catatanJual');
    }
}
