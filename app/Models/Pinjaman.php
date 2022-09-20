<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'tgl_pinjaman',
        'total_pinjaman',
        'nominal_cicilan',
        'jatuh_tempo',
        'sisa_cicilan',
        'status'
    ];

    /**
     * Get the user that owns the pinjaman
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation to model cicilan
     */
    public function cicilan()
    {
        return $this->hasMany(Cicilan::class);
    }

    /**
     * Relation to model detail pinjaman
     */
    public function detail_pinjaman()
    {
        return $this->hasMany(DetailPinjaman::class);
    }
}