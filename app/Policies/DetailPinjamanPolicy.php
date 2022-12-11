<?php

namespace App\Policies;

use App\Models\DetailPinjaman;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DetailPinjamanPolicy
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
     * @param  \App\Models\DetailPinjaman  $detailPinjaman
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, DetailPinjaman $detailPinjaman)
    {
        if($user->jabatan->value == 'bendahara' || $user->jabatan->value == 'pegawai-keuangan' || 
            $user->jabatan->value == 'pegawai-barang-jasa' || $user->username == auth()->user()->username)
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
     * @param  \App\Models\DetailPinjaman  $detailPinjaman
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, DetailPinjaman $detailPinjaman)
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
     * @param  \App\Models\DetailPinjaman  $detailPinjaman
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, DetailPinjaman $detailPinjaman)
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
     * @param  \App\Models\DetailPinjaman  $detailPinjaman
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, DetailPinjaman $detailPinjaman)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DetailPinjaman  $detailPinjaman
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, DetailPinjaman $detailPinjaman)
    {
        return false;
    }
}
