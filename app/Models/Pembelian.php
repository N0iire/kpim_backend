<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
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
        
        $query->when($filters['catatan-beli'] ?? false, function($query, $catatanBeli)
        {
            return $query->whereHas('catatanBeli', function($query) use($catatanBeli)
            {
                $query->where('id', $catatanBeli);
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

    public function catatanBeli()
    {
        return $this->belongsTo(CatatanBeli::class, 'id_catatanBeli');
    }
}
