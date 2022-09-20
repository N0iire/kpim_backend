<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailNonPembelian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_pengeluaran',
        'nama_transaksi',
        'tgl_transaksi',
        'nominal_transaksi',
        'ket'
    ];

    /**
     * Get the pengeluaran that owns the detail non pembelian
     */
    public function pengeluaran()
    {
        return $this->belongsTo(Pengeluaran::class);
    }
}
