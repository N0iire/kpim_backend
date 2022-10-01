<?php

namespace App\Providers;

use App\Models\SimpananWajib;
use App\Models\User;
use App\Policies\SimpananWajibPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /**
         * Authorizing user model
         */
        Gate::define('can-create-user', function(User $user) {
            if($user->jabatan->value == 'sekretaris' || $user->jabatan->value == 'pegawai-sekretariat' || $user->jabatan->value == 'ketua'){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('can-viewAny-user', function(User $user) {
            if($user->jabatan->value == 'sekretaris' || $user->jabatan->value == 'pegawai-sekretariat' || $user->jabatan->value == 'ketua'){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('can-view-user', function(User $user) {
            if($user->jabatan->value == 'sekretaris' || $user->jabatan->value == 'pegawai-sekretariat' || $user->id = Auth::user()->id)
            {
                return true;
            }else{
                return false;
            }
        });
        Gate::define('can-update-user', function(User $user) {
            if($user->jabatan->value == 'sekretaris' || $user->jabatan->value == 'pegawai-sekretariat' || $user->id = Auth::user()->id)
            {
                return true;
            }else{
                return false;
            }
        });
        Gate::define('can-delete-user', function(User $user) {
            if($user->jabatan->value == 'sekretaris' || $user->jabatan->value == 'pegawai-sekretariat' || $user->jabatan->value == 'ketua')
            {
                return true;
            }else{
                return false;
            }
        });

        /**
         * Authorizing Simpanan Wajib, Simpanan Pokok & Simpanan Sukarela
         */
        Gate::define('can-create-simpanan', function(User $user) {
            if($user->jabatan->value == 'sekretaris' || $user->jabatan->value == 'pegawai-keuangan' || $user->jabatan->value == 'bendahara'){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('can-viewAny-simpanan', function(User $user) {
            if($user->jabatan->value == 'sekretaris' || $user->jabatan->value == 'pegawai-keuangan' || $user->jabatan->value == 'bendahara'){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('can-view-simpanan', function(User $user) {
            if($user->jabatan->value == 'sekretaris' || $user->jabatan->value == 'pegawai-keuangan' || $user->jabatan->value == 'bendahara' || $user->id == Auth::user()->id){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('can-update-simpanan', function(User $user) {
            if($user->jabatan->value == 'sekretaris' || $user->jabatan->value == 'pegawai-keuangan' || $user->jabatan->value == 'bendahara' || $user->id == Auth::user()->id){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('can-delete-simpanan', function(User $user) {
            if($user->jabatan->value == 'sekretaris' || $user->jabatan->value == 'bendahara'|| $user->jabatan->value == 'ketua' || $user->id == Auth::user()->id){
                return true;
            }else{
                return false;
            }
        });

        /**
         * Authorizing Pinjaman Model
         */
        // your code goes here ..

        /**
         * Authorizing Penjualan Model
         */
        // your code goes here ..

        /**
         * Authorizing Pengeluaran & Pemasukan Model
         */
        Gate::define('can-create-laporan', function(User $user) {
            if($user->jabatan->value == 'sekretaris' || $user->jabatan->value == 'bendahara'){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('can-viewAny-laporan', function(User $user) {
            if($user->jabatan->value == 'sekretaris' || $user->jabatan->value == 'bendahara'){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('can-view-laporan', function(User $user) {
            if($user->jabatan->value == 'sekretaris' || $user->jabatan->value == 'bendahara'){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('can-find-laporan', function(User $user) {
            if($user->jabatan->value == 'sekretaris' || $user->jabatan->value == 'bendahara'){
                return true;
            }else{
                return false;
            }
        });

        /**
         * Authorizing Pemodal Model
         */
        Gate::define('can-create-pemodal', function(User $user) {
            if($user->jabatan->value == 'sekretaris' || $user->jabatan->value == 'pegawai-keuangan' || $user->jabatan->value == 'bendahara'){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('can-viewAny-pemodal', function(User $user) {
            if($user->jabatan->value == 'sekretaris' || $user->jabatan->value == 'pegawai-keuangan' || $user->jabatan->value == 'bendahara'){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('can-view-pemodal', function(User $user) {
            if($user->jabatan->value == 'sekretaris' || $user->jabatan->value == 'pegawai-keuangan' || $user->jabatan->value == 'bendahara'){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('can-update-pemodal', function(User $user) {
            if($user->jabatan->value == 'sekretaris' || $user->jabatan->value == 'pegawai-keuangan' || $user->jabatan->value == 'bendahara'){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('can-delete-pemodal', function(User $user) {
            if($user->jabatan->value == 'sekretaris' || $user->jabatan->value == 'pegawai-keuangan' || $user->jabatan->value == 'bendahara'){
                return true;
            }else{
                return false;
            }
        });
    }
}
