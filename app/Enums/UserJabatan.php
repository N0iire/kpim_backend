<?php

namespace App\Enums;

enum UserJabatan: string
{
    case Anggota = 'anggota';
    case Ketua = 'ketua';
    case Sekretaris = 'sekretaris';
    case Bendahara  = 'bendahara';
    case PegawaiSekretariat = 'pegawai-sekretariat';
    case PegawaiKeuangan = 'pegawai-keuangan';
    case PegawaiBarangJasa = 'pegawai-barangjasa';
}
