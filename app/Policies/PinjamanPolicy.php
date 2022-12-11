<?php

namespace App\Policies;

use App\Models\Pinjaman;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PinjamanPolicy
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
        if($user->jabatan->value == 'bendahara' || $user->jabatan->value == 'pegawai-keuangan' || 
            $user->jabatan->value == 'pegawai-barang-jasa' || $user->username == auth()->user()->username)
        {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Pinjaman $pinjaman)
    {
        if($user->jabatan->value == 'bendahara' || $user->jabatan->value == 'pegawai-keuangan' || $user->jabatan->value == 'pegawai-barang-jasa')
        {
            return true;
        }
        else if($user->username == auth()->user()->username && $user->id == $pinjaman->id_user)
        {
            return true;
        }

        return false;
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
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Pinjaman $pinjaman)
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
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Pinjaman $pinjaman)
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
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Pinjaman $pinjaman)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Pinjaman $pinjaman)
    {
        return false;
    }
}
