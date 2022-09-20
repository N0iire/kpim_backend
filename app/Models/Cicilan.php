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

    /**
     * Get the pinjaman that owns the cicilan
     */
    public function pinjaman()
    {
        return $this->belongsTo(PinjamanController::class);
    }
}
