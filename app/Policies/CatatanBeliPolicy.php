<?php

namespace App\Policies;

use App\Models\CatatanBeli;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CatatanBeliPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if($user->jabatan->value == 'anggota' || $user->jabatan->value == 'ketua')
        {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CatatanBeli  $catatanBeli
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, CatatanBeli $catatanBeli)
    {
        if($user->jabatan->value == 'anggota' || $user->jabatan->value == 'ketua')
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
        if($user->jabatan->value == 'bendahara' || $user->jabatan->value == 'pegawai-barang-jasa')
        {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CatatanBeli  $catatanBeli
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, CatatanBeli $catatanBeli)
    {
        if($user->jabatan->value == 'bendahara' || $user->jabatan->value == 'pegawai-barang-jasa')
        {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CatatanBeli  $catatanBeli
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, CatatanBeli $catatanBeli)
    {
        if($user->jabatan->value == 'bendahara' || $user->jabatan->value == 'pegawai-barang-jasa')
        {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CatatanBeli  $catatanBeli
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, CatatanBeli $catatanBeli)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CatatanBeli  $catatanBeli
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, CatatanBeli $catatanBeli)
    {
        return false;
    }
}
