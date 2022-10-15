<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;


class Pemodal extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'id_user',
        'nama_pemodal',
        'tgl_bayar',
        'nominal_modal'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'pemodals',
                                        'length' => 8, 'prefix' =>date('ym')]);
        });
    }

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
            return $query->where('nama_pemodal', 'like', '%'.$search.'%')
                         ->orWhere('tgl_bayar', 'like', '%'.$search.'%');
        });
    }

    /**
     * Get the user that owns the pemodal
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
