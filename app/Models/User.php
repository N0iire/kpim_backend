<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\UserJabatan;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'avatar',
        'nik',
        'nama_anggota',
        'alamat',
        'ttl',
        'pekerjaan',
        'tgl_daftar',
        'status',
        'jabatan'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'jabatan' => UserJabatan::class
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }

    /**
     * Relation to model SimpananWajib
     *
     * One to Many
     */
    public function simpanan_wajib()
    {
        return $this->hasMany(SimpananWajib::class, 'id_user');
    }

    /**
     * Relation to model SimpananPokok
     *
     * One to One
     */
    public function simpanan_pokok()
    {
        return $this->hasOne(SimpananPokok::class, 'id_user');
    }

    /**
     * Relation to model SimpananSukarela
     *
     * One to One
     */
    public function simpanan_sukarela()
    {
        return $this->hasMany(SimpananSukarela::class, 'id_user');
    }

    /**
     * Relation to model Pemodal
     *
     * One to Many
     */
    public function pemodal()
    {
        return $this->hasMany(Pemodal::class, 'id_user');
    }

    /**
     * Relation to model Pinjaman
     *
     * One to Many
     */
    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'id_user');
    }

    /**
     * Relation to model CatatanJual
     *
     * One to Many
     */
    public function catatan_jual()
    {
        return $this->hasMany(CatatanJual::class, 'id_user');
    }

    /**
     * Relation to model CatatanBeli
     *
     * One to Many
     */
    public function catatan_beli()
    {
        return $this->hasMany(CatatanBeli::class, 'id_user');
    }

}
