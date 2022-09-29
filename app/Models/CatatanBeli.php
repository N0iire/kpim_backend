<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanBeli extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function anggota()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'id_catatanBeli');
    }
}
