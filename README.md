<br>

# <p align=center>API Koperasi Pekerja Indonesia Maju</p>

<br>

## Tentang API KPIM

API Koperasi Pekerja Indonesia Maju atau API KPIM merupakan API yang dibangun untuk keperluan Sistem Informasi Koperasi Pekerja Indonesia Maju.
API ini dibangun untuk dipergunakan secara khusus oleh Koperasi Pekerja Indonesia Maju dan tidak untuk diperjualbelikan. Disisi lain, pembangunan API ini juga ditujukan untuk memenuhi tugas Kerja Praktek Universitas Komputer Indonesia. Tim pengembang API KPIM memohon kepada seluruh pihak yang menggunakan API KPIM agar API ini digunakan sebagaimana mestinya.

## Petunjuk Penggunaan

Format URL utama adalah : `https://kpim_backend.test/api/<parameter>`
<p>Berikut adalah petunjuk penggunaan API KPIM berdasarkan format URL beserta parameter dan data - data yang dibutuhkan :</p>

### Index
Metode : `GET`
| Nama Tabel           | Parameter             |
|----------------------|-----------------------|
| Barang               | /barang               |
| Catatan Beli         | /catatan-beli         |
| Catatan Jual         | /catatan-jual         |
| Cicilan              | /cicilan              |
| Detail Non Pembelian | /detail-non-pembelian |
| Detail Pinjaman      | /detail-pinjaman      |
| Pengeluaran          | /pengeluaran          |
| Penjualan            | /penjualan            |
| Pemasukan            | /pemasukan            |
| Pembelian            | /pembelian            |
| Pemodal              | /pemodal              |
| Pinjaman             | /pinjaman             |
| Simpanan Pokok       | /simpanan-pokok       |
| Simpanan Sukarela    | /simpanan-sukarela    |
| Simpanan Wajib       | /simpanan-wajib       |
| User                 | /user                 |

#### Parameter Tambahan
Permintaan `index` dapat diberikan parameter tambahan untuk memudahkan pengambilan data.
Parameter tambahan dapat digunakan dengan cara menambahkan parameter baru setelah simbol `?`. Contoh :
` https://kpim_backend.test/api/catatan-beli?username=asep123 `.
Berikut adalah daftar parameter tambahan untuk setiap tabel :
| Nama Tabel           | Parameter                                          |
|----------------------|----------------------------------------------------|
| Catatan Beli         | username=(username)                                |
| Catatan Jual         | username=(username)                                |
| Cicilan              | pinjaman=(id_pinjaman)                             |
| Detail Non Pembelian | pengeluaran=(id_pengeluaran)                       |
| Detail Pinjaman      | pinjaman=(id_pinjaman), barang=(id_barang)         |
| Pemodal              | username=(username)                                |
| Pembelian            | barang=(id_barang), catatan-beli=(id_catatan_beli) |
| Penjualan            | barang=(id_barang), catatan-jual=(id_catatan_jual) |
| Pinjaman             | username=(username)                                |
| Simpanan Pokok       | username=(username)                                |
| Simpanan Sukarela    | username=(username)                                |
| Simpanan Wajib       | username=(username)                                |

#### 
