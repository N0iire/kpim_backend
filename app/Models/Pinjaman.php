<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $table = 'pinjamans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'tgl_pinjaman',
        'total_pinjaman',
        'durasi_cicilan',
        'nominal_cicilan',
        'jatuh_tempo',
        'sisa_cicilan',
        'status'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['username'] ?? false, function($query, $user)
        {
            return $query->whereHas('user', function($query) use($user)
            {
                $query->where('username', $user);
            });
        });

        $query->when($filters['search'] ?? false, function($query, $search)
        {
            return $query->where('tgl_pinjaman', 'like', '%'.$search.'%');
        });
    }

    /**
     * Get the user that owns the pinjaman
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Relation to model cicilan
     */
    public function cicilan()
    {
        return $this->hasMany(Cicilan::class, 'id_pinjaman');
    }

    /**
     * Relation to model detail pinjaman
     */
    public function detail_pinjaman()
    {
        return $this->hasMany(DetailPinjaman::class, 'id_pinjaman');
    }
}
