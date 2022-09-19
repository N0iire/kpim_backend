<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimpananWajib extends Model
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
        'tgl_bayar',
        'nominal_wajib',
        'status_simp',
        'ket'
    ];

    /**
    * Get the user that owns the simpanan wajib.
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
