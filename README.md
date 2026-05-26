# Sistem Parkir

Sistem parkir ini adalah aplikasi web yang dibangun menggunakan Laravel untuk mengelola kendaraan yang masuk dan keluar dari area parkir, serta menghitung biaya parkir secara otomatis.

## Fitur

*   **Manajemen Petugas**: Mengelola data petugas yang bertanggung jawab di setiap pos.
*   **Manajemen Jenis Kendaraan**: Mengatur jenis kendaraan (misalnya, motor, mobil) beserta tarif parkir per hari.
*   **Pencatatan Transaksi**: Mencatat setiap kendaraan yang masuk dan keluar, lengkap dengan waktu dan petugas yang melayani.
*   **Perhitungan Biaya Otomatis**: Sistem secara otomatis menghitung total biaya parkir berdasarkan durasi dan jenis kendaraan.
*   **Laporan Riwayat Transaksi**: Menyediakan laporan lengkap mengenai semua transaksi yang pernah terjadi.

## Entity-Relationship Diagram (ERD)

ERD berikut ini menggambarkan bagaimana tabel-tabel dalam basis data saling terhubung. Diagram ini didasarkan pada file migrasi dan model Eloquent yang ada di dalam proyek.

### Tabel

1.  **`users`**
    *   **File Model**: `app/Models/User.php`
    *   **File Migrasi**: `database/migrations/0001_01_01_000000_create_users_table.php`
    *   **Deskripsi**: Menyimpan data petugas yang memiliki akses ke sistem.
    *   **Kolom**:
        *   `id`: *Primary Key*
        *   `nama_petugas`: Nama lengkap petugas.
        *   `email`: Alamat email untuk login.
        *   `password`: Kata sandi yang sudah di-hash.
        *   `shift`: Jadwal kerja petugas.

2.  **`tabel_jenis_kendaraan`**
    *   **File Model**: `app/Models/JenisKendaraan.php`
    *   **File Migrasi**: `database/migrations/2025_11_07_134122_create_tabel_jenis_kendaraan_table.php`
    *   **Deskripsi**: Menyimpan informasi mengenai jenis kendaraan dan tarifnya.
    *   **Kolom**:
        *   `id_jenis`: *Primary Key*
        *   `nama_jenis`: Nama jenis kendaraan (contoh: "Motor", "Mobil").
        *   `tarif_per_hari`: Biaya parkir untuk satu hari penuh.

3.  **`tabel_transaksi`**
    *   **File Model**: `app/Models/Transaksi.php`
    *   **File Migrasi**: `database/migrations/2025_11_07_134232_create_tabel_transaksi_table.php`
    *   **Deskripsi**: Mencatat semua aktivitas parkir.
    *   **Kolom**:
        *   `id_tiket`: *Primary Key*, nomor unik untuk setiap tiket parkir.
        *   `jam_masuk`: Waktu saat kendaraan masuk.
        *   `jam_keluar`: Waktu saat kendaraan keluar.
        *   `total_biaya`: Total biaya parkir yang harus dibayar.
        *   `id_jenis_fk`: *Foreign Key* yang terhubung ke `tabel_jenis_kendaraan`.
        *   `id_petugas_fk`: *Foreign Key* yang terhubung ke `users`.

### Relasi

*   **Satu Petugas ke Banyak Transaksi**: Satu `User` (petugas) dapat melayani banyak `Transaksi`.
    *   Relasi ini didefinisikan dalam model <mcsymbol name="transaksi" filename="User.php" path="c:\laragon\www\sistem-parkir\app\Models\User.php" startline="37" type="function"></mcsymbol>.
*   **Satu Jenis Kendaraan ke Banyak Transaksi**: Satu `JenisKendaraan` dapat dimiliki oleh banyak `Transaksi`.
    *   Relasi ini didefinisikan dalam model <mcsymbol name="transaksi" filename="JenisKendaraan.php" path="c:\laragon\www\sistem-parkir\app\Models\JenisKendaraan.php" startline="22" type="function"></mcsymbol>.
*   **Satu Transaksi Milik Satu Petugas**: Setiap `Transaksi` dicatat oleh satu `User` (petugas).
    *   Relasi ini didefinisikan dalam model <mcsymbol name="petugas" filename="Transaksi.php" path="c:\laragon\www\sistem-parkir\app\Models\Transaksi.php" startline="38" type="function"></mcsymbol>.
*   **Satu Transaksi Milik Satu Jenis Kendaraan**: Setiap `Transaksi` terikat pada satu `JenisKendaraan`.
    *   Relasi ini didefinisikan dalam model <mcsymbol name="jenisKendaraan" filename="Transaksi.php" path="c:\laragon\www\sistem-parkir\app\Models\Transaksi.php" startline="33" type="function"></mcsymbol>.

## Cara Kerja Sistem

1.  **Kendaraan Masuk**:
    *   Petugas memilih jenis kendaraan.
    *   Sistem menghasilkan `id_tiket` unik dan mencatat `jam_masuk`.
    *   Data transaksi baru disimpan di `tabel_transaksi` dengan `jam_keluar` dan `total_biaya` masih kosong.

2.  **Kendaraan Keluar**:
    *   Petugas memasukkan `id_tiket`.
    *   Sistem mencari data transaksi, mencatat `jam_keluar`, dan menghitung durasi parkir.
    *   `total_biaya` dihitung berdasarkan `tarif_per_hari` dari `tabel_jenis_kendaraan` dan durasi parkir.
    *   Data transaksi diperbarui, dan petugas yang melayani (`id_petugas_fk`) dicatat.

3.  **Laporan**:
    *   Admin atau manajer dapat melihat seluruh riwayat transaksi yang tersimpan di `tabel_transaksi` untuk keperluan audit atau analisis.