<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tgl_buat',
        'total_pembelian',
        'total_pinjaman',
        'total_non_pembelian'
    ];

    /**
     * Relation Pengeluaran to detail non pembelian
     */
    public function pembelian()
    {
        return $this->hasMany(DetailNonPembelian::class);
    }
}
