<?php

namespace App\Policies;

use App\Models\Barang;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BarangPolicy
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
        if($this->jabatan == 'anggota')
        {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Barang $barang)
    {
        if($this->jabatan == 'bendahara' || $this->jabatan == 'pegawai-keuangan' || $this->jabatan == 'pegawai-barang-jasa'
        || $this->jabatan == 'ketua')
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
        if($this->jabatan == 'bendahara' || $this->jabatan == 'pegawai-barang-jasa')
        {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Barang $barang)
    {
        if($this->jabatan == 'bendahara' || $this->jabatan == 'pegawai-barang-jasa')
        {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Barang $barang)
    {
        if($this->jabatan == 'bendahara' || $this->jabatan == 'pegawai-barang-jasa')
        {
            return true;
        }
        
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Barang $barang)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Barang $barang)
    {
        return false;
    }
}
