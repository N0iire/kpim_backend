<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['barang'] ?? false, function($query, $barang)
        {
            return $query->whereHas('barang', function($query) use($barang)
            {
                $query->where('id', $barang);
            });
        });

        $query->when($filters['catatan-jual'] ?? false, function($query, $catatanJual)
        {
            return $query->whereHas('catatanJual', function($query) use($catatanJual)
            {
                $query->where('id', $catatanJual);
            });
        });

        $query->when($filters['search'] ?? false, function($query, $search)
        {
            return $query->where('id', $search);
        });
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function catatanJual()
    {
        return $this->belongsTo(CatatanJual::class, 'id_catatanJual');
    }
}
