<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemodal extends Model
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
        'nama_pemodal',
        'tgl_bayar',
        'nominal_modal'
    ];

    /**
     * Get the user that owns the pemodal
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
