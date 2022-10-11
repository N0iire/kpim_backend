<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanJual extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['username'] ?? false, function($query, $user)
        {
            return $query->whereHas('anggota', function($query) use($user)
            {
                $query->where('username', $user);
            });
        });

        $query->when($filters['search'] ?? false, function($query, $search)
        {
            return $query->where('tgl_penjualan', 'like', '%'.$search.'%')
                         ->orWhere('nama_pembeli', 'like', '%'.$search.'%');
        });
    }

    public function anggota()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'id_catatanJual');
    }
}
