<?php

namespace App\Policies;

use App\Models\Pemodal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PemodalPolicy
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
        if($user->jabatan->value == 'bendahara' || $user->jabatan->value == 'pegawai-keuangan')
        {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pemodal  $pemodal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Pemodal $pemodal)
    {
        if($user->jabatan->value == 'bendahara' || $user->jabatan->value == 'pegawai-keuangan')
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
     * @param  \App\Models\Pemodal  $pemodal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Pemodal $pemodal)
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
     * @param  \App\Models\Pemodal  $pemodal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Pemodal $pemodal)
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
     * @param  \App\Models\Pemodal  $pemodal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Pemodal $pemodal)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pemodal  $pemodal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Pemodal $pemodal)
    {
        return false;
    }
}
