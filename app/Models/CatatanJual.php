<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanJual extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->no_transaksi = IdGenerator::generate([
                                                'table' => 'catatan_juals',
                                                'length' => 8, 
                                                'prefix' => date('ym'),
                                                'reset_on_prefix_change' => true
                                            ]);
        });
    }

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
