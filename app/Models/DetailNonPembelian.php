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

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['pengeluaran'] ?? false, function($query, $pengeluaran)
        {
            return $query->whereHas('pengeluaran', function($query) use($pengeluaran)
            {
                $query->where('id', $pengeluaran);
            });
        });

        $query->when($filters['search'] ?? false, function($query, $search)
        {
            return $query->where('nama_transaksi', 'like', '%'.$search.'%')
                         ->orWhere('tgl_transaksi', 'like', '%'.$search.'%');
        });
    }

    /**
     * Get the pengeluaran that owns the detail non pembelian
     */
    public function pengeluaran()
    {
        return $this->belongsTo(Pengeluaran::class, 'id_pengeluaran');
    }
}
