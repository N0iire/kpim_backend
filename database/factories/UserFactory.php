<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->userName(),
            'api_token' => $this->faker->md5(),
            'password' => Hash::make('password'),
            'nik' => $this->faker->nik(),
            'nama_anggota' => $this->faker->name(),
            'alamat' => $this->faker->address(),
            'ttl' => $this->faker->city().",".$this->faker->date(),
            'pekerjaan' => $this->faker->jobTitle(),
            'tgl_daftar' => $this->faker->date(),
            'status' => $this->faker->boolean(),
            'jabatan' => collect(['anggota', 'ketua', 'sekretaris', 'bendahara', 'pegawai-sekretariat', 'pegawai-keuangan',
            'pegawai-barangjasa'])->random(),
            'keanggotaan' => $this->faker->boolean(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    // public function unverified()
    // {
    //     return $this->state(function (array $attributes) {
    //         return [
    //             'email_verified_at' => null,
    //         ];
    //     });
    // }
}
