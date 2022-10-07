<?php

namespace App\Models;

use App\Http\Controllers\PinjamanController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cicilan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_pinjaman',
        'tgl_bayar',
        'nominal_bayar'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['pinjaman'] ?? false, function($query, $pinjaman)
        {
            return $query->whereHas('pinjaman', function($query) use($pinjaman)
            {
                $query->where('id', $pinjaman);
            });
        });

        $query->when($filters['search'] ?? false, function($query, $search)
        {
            return $query->where('tgl_bayar', 'like', '%'.$search.'%');
        });
    }

    /**
     * Get the pinjaman that owns the cicilan
     */
    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class, 'id_pinjaman');
    }
}
