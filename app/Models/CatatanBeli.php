<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanBeli extends Model
{
    use HasFactory;

    public function anggota()
    {
        return $this->belongsTo(User::class);
    }

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class);
    }
}
