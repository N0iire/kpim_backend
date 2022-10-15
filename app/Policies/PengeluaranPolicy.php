<?php

namespace App\Policies;

use App\Models\Pengeluaran;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PengeluaranPolicy
{
    use HandlesAuthorization;

    private $jabatan;

    public function __construct(User $user)
    {
        $this->jabatan = $user->jabatan;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if($this->jabatan == 'pegawai-barang-jasa' || $this->jabatan == 'anggota')
        {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Pengeluaran $pengeluaran)
    {
        if($this->jabatan == 'pegawai-barang-jasa' || $this->jabatan == 'anggota' || $this->jabatan == 'ketua')
        {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if($this->jabatan == 'sekretaris' || $this->jabatan == 'pegawai-sekretariat')
        {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Pengeluaran $pengeluaran)
    {
        if($this->jabatan == 'sekretaris' || $this->jabatan == 'pegawai-sekretariat')
        {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Pengeluaran $pengeluaran)
    {
        if($this->jabatan == 'sekretaris' || $this->jabatan == 'pegawai-sekretariat')
        {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Pengeluaran $pengeluaran)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Pengeluaran $pengeluaran)
    {
        return false;
    }
}
