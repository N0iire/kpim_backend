<?php

namespace App\Models;

use Carbon\Carbon;
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
        'nominal_bayar',
        'status',
        'ket'
    ];

    protected $attributes = [
        'status' => false,
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
            return $query->where('tgl_bayar', 'like', '%'.$search.'%');
        });

        $query->when(isset($filters['reminder']) ? $filters['username'] : false, function($query, $user)
        {
            return $query->whereHas('user', function($query) use($user)
            {
                $query->where('username', $user);
            })
            ->where('status', 0);
        });
    }

    /**
     * Get the user that owns the simpanan wajib.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
