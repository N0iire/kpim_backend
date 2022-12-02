<?php

namespace App\Policies;

use App\Models\SimpananSukarela;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SimpananSukarelaPolicy
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
        if($user->jabatan->value == 'pegawai-barang-jasa' || $user->jabatan->value == 'anggota' || $user->jabatan->value == 'ketua')
        {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SimpananSukarela  $simpananSukarela
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, SimpananSukarela $simpananSukarela)
    {
        if($user->jabatan->value == 'pegawai-barang-jasa' || $user->jabatan->value == 'ketua')
        {
            return false;
        }
        else if($user->jabatan->value == 'anggota' && $user->username == auth()->user()->username)
        {
            return true;
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
        if($user->jabatan->value == 'bendahara' || $user->jabatan->value == 'pegawai-keuangan')
        {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SimpananSukarela  $simpananSukarela
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, SimpananSukarela $simpananSukarela)
    {
        if($user->jabatan->value == 'bendahara' || $user->jabatan->value == 'pegawai-keuangan')
        {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SimpananSukarela  $simpananSukarela
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, SimpananSukarela $simpananSukarela)
    {
        if($user->jabatan->value == 'bendahara' || $user->jabatan->value == 'pegawai-keuangan')
        {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SimpananSukarela  $simpananSukarela
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, SimpananSukarela $simpananSukarela)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SimpananSukarela  $simpananSukarela
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, SimpananSukarela $simpananSukarela)
    {
        return false;
    }
}
