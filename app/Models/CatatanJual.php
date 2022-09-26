<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanJual extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function anggota()
    {
        return $this->belongsTo(User::class);
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }
}
