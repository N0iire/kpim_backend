<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPinjaman extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $table = 'detail_pinjamans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_pinjaman',
        'id_barang',
        'jumlah',
        'sub_total'
    ];

    /**
     * Get the barang that owns the detail pinjaman
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    /**
     * Get the pinjaman that owns the detail pinjaman
     */
    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class, 'id_pinjaman');
    }


}
