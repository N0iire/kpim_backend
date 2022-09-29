<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'id_barang');
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'id_barang');
    }

    public function detailPinjam()
    {
        return $this->hasMany(DetailPinjaman::class, 'id_barang');
    }
}
