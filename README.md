# PANDUAN OPERASIONAL DAN ARSITEKTUR SISTEM: SISTEM MANAJEMEN PARKIR

## ❖ BAGIAN 1: PENGENALAN SISTEM

Platform ini merupakan sistem otomasi manajemen operasional perparkiran kendaraan bermotor yang dirancang untuk memproses pencatatan kendaraan masuk, penghitungan tarif otomatis berbasis waktu, hingga manajemen data administratif petugas dan riwayat pendapatan transaksi keuangan secara seketika (*real-time*).

### 1.1 Tujuan Utama Sistem

Tujuan fundamental dari pembangunan sistem ini adalah menggantikan metode pencatatan parkir manual dengan pendekatan digital guna meminimalkan risiko kebocoran pendapatan, mereduksi waktu antrean kendaraan di gerbang pos, serta menyediakan transparansi data transaksi perparkiran bagi pihak pengelola.

### 1.2 Target Pengguna (Aktor Sistem)

* **Petugas Pos Masuk (Gate In Operator):** Bertanggung jawab mendaftarkan nomor plat kendaraan dan mengonfirmasi jenis kendaraan untuk mencetak karcis masuk.


* **Petugas Pos Keluar (Gate Out Operator):** Bertanggung jawab memindai kode karcis, memverifikasi kesesuaian fisik kendaraan, memproses kalkulasi tarif otomatis, dan menerima pembayaran.


* **Manajer / Administrator Utama:** Memiliki akses menyeluruh terhadap pengaturan tarif jenis kendaraan, manajemen akun petugas (termasuk pembagian *shift* kerja), serta pemantauan dasbor analitik grafik pendapatan.



---

## ❖ BAGIAN 2: ARSITEKTUR SISTEM DAN TUMPUKAN TEKNOLOGI

Aplikasi ini dibangun menggunakan arsitektur monolitik modern berbasis kerangka kerja PHP terkemuka yang dikombinasikan dengan pustaka komponen antarmuka reaktif tingkat lanjut.

```
                                  +-----------------------+
                                  |     CLIENT BROWSER    |
                                  +-----------+-----------+
                                              |
                                              | HTTP Requests / Livewire AJAX
                                              v
                                  +-----------+-----------+
                                  |    LARAVEL CORE FRAME |
                                  +-----+-----------+-----+
                                        |           |
             +--------------------------+           +--------------------------+
             |                                                                 |
             v                                                                 v
+------------+------------+                                       +------------+------------+
|    CONTROLLER PORTAL    |                                       |   LIVEWIRE REACTIVE UI  |
+-------------------------+                                       +-------------------------+
| - KarcisController      |                                       | - DashboardPage         |
| - PosKeluarController   |                                       | - ManajemenKendaraanPage|
| - Auth Controllers      |                                       | - RiwayatTransaksiPage  |
+------------+------------+                                       +------------+------------+
             |                                                                 |
             +--------------------------+           +--------------------------+
                                        |           |
                                        v           v
                                  +-----------+-----------+
                                  |   DATABASE / ENGINE   |
                                  +-----------+-----------+
                                  | - MySQL / PostgreSQL  |
                                  | - Eloquent ORM Maps   |
                                  +-----------------------+

```

### 2.1 Lapisan Backend (Inti Aplikasi)

* **Laravel Framework:** Bertindak sebagai fondasi utama penanganan logika bisnis, sistem keamanan perutean (routing), manajemen sesi pengguna, otentikasi multi-user, dan pemetaan basis data objek (*Eloquent ORM*).



### 2.2 Lapisan Antarmuka Reaktif (Frontend)

* **Livewire Engine:** Mengendalikan komponen antarmuka secara dinamis langsung dari backend PHP tanpa penulisan skrip JavaScript manual terpisah, memungkinkan pembaruan data asinkronus (*real-time DOM updates*) pada dasbor administratif.


* **Alpine.js & Tailwind CSS:** Digunakan untuk optimalisasi interaktivitas mikro sisi klien dan penataan gaya visual komponen agar responsif, modern, dan ringan.



### 2.3 Pustaka Eksternal Tambahan (Libraries)

* **Axios.js (`axios.min.js`):** Memfasilitasi komunikasi pengiriman data secara asinkronus ke server pada bagian-bagian spesifik aplikasi.


* **Html5-Qrcode (`html5-qrcode.min.js`):** Modul pembaca kamera untuk memindai kode QR atau kode batang karcis secara langsung pada gerbang pos keluar.



---

## ❖ BAGIAN 3: FITUR UTAMA YANG TERSEDIA

### 3.1 Dasbor Analitik & Statistik (`DashboardPage.php` / `dashboard.blade.php`)

* **Ringkasan Metrik Finansial:** Menampilkan indikator performa utama berupa total pendapatan harian, akumulasi mingguan, jumlah kendaraan aktif di dalam area parkir, serta total transaksi berhasil.


* **Grafik Tren Pendapatan (`SuratChart.php` / `chart.js`):** Visualisasi grafis berbentuk bagan untuk menganalisis tren fluktuasi volume kendaraan dan pendapatan per periode waktu tertentu.



### 3.2 Pos Masuk & Manajemen Karcis (`KarcisController.php` / `karcis.blade.php`)

* **Pencatatan Masuk Kendaraan:** Menyediakan form input nomor plat kendaraan dan pemilihan kategori kendaraan.


* **Generasi Struktur Dokumen Karcis (`karcis-printable.blade.php`):** Menyusun tata letak lembar struk karcis parkir resmi yang dilengkapi kode identifikasi unik, tanggal/jam masuk, dan petunjuk operasional parkir yang siap dicetak oleh mesin printer termal.



### 3.3 Pos Keluar & Validasi Transaksi (`PosKeluarController.php` / `pos-keluar.blade.php`)

* **Pemindaian Karcis Terintegrasi:** Memanfaatkan pustaka kamera untuk membaca data karcis masuk secara instan.


* **Kalkulator Tarif Otomatis:** Menghitung durasi parkir berdasarkan selisih waktu masuk dan keluar, lalu mengalikannya dengan tarif per jam yang berlaku sesuai jenis kendaraan.


* **Konfirmasi Pembayaran:** Memproses pencatatan nominal uang yang diterima dan menghitung kembalian sebelum membuka palang pintu keluar.



### 3.4 Manajemen Konfigurasi Administrasi (Livewire Component Group)

* **Manajemen Jenis Kendaraan (`JenisKendaraanPage.php`):** Modul kontrol untuk menambah kategori kendaraan (misal: Mobil, Sepeda Motor, Truk) beserta penentuan tarif dasar dan tarif jam berikutnya.


* **Manajemen Kendaraan Aktif (`ManajemenKendaraanPage.php`):** Panel pengawasan khusus untuk memantau detail kendaraan yang saat ini sedang berada di dalam gedung atau area parkir.


* **Manajemen Petugas & Shift (`PetugasPage.php`):** Pengelolaan data akun operator lapangan, pengaturan kata sandi, serta pembagian penugasan jam kerja (*shift*).


* **Audit Riwayat Transaksi (`RiwayatTransaksiPage.php`):** Log riwayat seluruh transaksi keuangan parkir lengkap dengan fitur pencarian dan penyaringan data secara spesifik.



---

## ❖ BAGIAN 4: DIAGRAM DAN ALUR KERJA SISTEM

### 4.1 Alur Transaksi Kendaraan Masuk & Keluar (Parking Transaction Pipeline)

```
[ KENDARAAN MASUK ] ---> Input Plat & Jenis Kendaraan (Pos Masuk) ---> Cetak Karcis (Printable Struk)
                                                                             |
                                                                             v
                                                                   Simpan Record: Transaksi
                                                                   (Status: Aktif)
                                                                             |
                                                                             v
                                                                    Kendaraan Masuk Area
                                                                             |
                                                                             +------> [ AREA PARKIR ]
                                                                             |
                                                                             v
[ KENDARAAN KELUAR ] --> Scan Karcis / Input Kode (Pos Keluar) <-------------+
                               |
                               v
                     Hitung Durasi Waktu & Tarif
                               |
                               v
                     Proses Bayar Tunai / Non-Tunai
                               |
                               v
                     Update Record: Transaksi (Status: Selesai, Waktu Keluar, Total Bayar)
                               |
                               v
                     Palang Pintu Terbuka

```

1. **Proses Masuk:** Petugas pos masuk menginput plat nomor kendaraan ke sistem melalui antarmuka `KarcisController`. Sistem mendaftarkan data ke tabel `transaksi` dengan status `aktif` (waktu masuk tercatat secara otomatis melalui fungsi *timestamp* server), kemudian mencetak dokumen via `karcis-printable.blade.php`.


2. **Proses Keluar:** Di gerbang keluar, karcis dipindai atau kode transaksi dimasukkan ke komponen `PosKeluarController`. Sistem mengambil data rekaman transaksi yang sesuai.


3. **Kalkulasi Tarif:** Sistem membaca data dari tabel `jenis_kendaraan` untuk memproses perhitungan biaya dengan formula komputasi sebagai berikut:

$$\text{Total Tarif} = \text{Tarif Dasar} + (\text{Durasi Jam Tambahan} \times \text{Tarif per Jam})$$


4. **Penyelesaian:** Petugas menerima pembayaran, sistem memperbarui status transaksi menjadi `selesai`, menginput parameter `waktu_keluar` serta nilai akumulasi rupiah ke dalam database.



---

## ❖ BAGIAN 5: SKEMA BASIS DATA DAN PEMETAAN ENTITAS

Struktur penyimpanan data relasional dirancang secara optimal melalui fail migrasi SQL peladen (`create_tabel_jenis_kendaraan_table.php`, `create_tabel_transaksi_table.php`, dan `add_shift_to_users_table.php`):

### 5.1 Tabel: `users`

Menyimpan data identitas kredensial pengguna dan operator sistem.

* `id` (BigInt, PK, Autoincrement)


* `name` (Varchar) – Nama lengkap pegawai/petugas.


* `email` (Varchar, Unique) – Surel untuk otentikasi login.


* `password` (Varchar) – Hash enkripsi kata sandi.


* `shift` (Varchar) – Pembagian waktu penugasan kerja (Contoh: `Pagi`, `Siang`, `Malam`).



### 5.2 Tabel: `jenis_kendaraan`

Menampung konfigurasi parameter aturan tarif per jenis kendaraan.

* `id` (BigInt, PK, Autoincrement)


* `nama_jenis` (Varchar) – Nama kategori kendaraan (Contoh: `Mobil`, `Motor`).


* `tarif_dasar` (Integer) – Biaya tetap pemuatan jam pertama.


* `tarif_perjam` (Integer) – Biaya tambahan untuk setiap jam berikutnya.



### 5.3 Tabel: `transaksi`

Entitas utama pencatat riwayat pergerakan kendaraan dan keuangan parkir.

* `id` (BigInt, PK, Autoincrement)


* `kode_transaksi` (Varchar, Unique) – Kode unik penanda karcis parkir.


* `no_plat` (Varchar) – Nomor polisi kendaraan.


* `jenis_kendaraan_id` (BigInt, FK -> `jenis_kendaraan.id`) – Relasi kategori kendaraan.


* `waktu_masuk` (Timestamp) – Waktu awal kendaraan memasuki pos parkir.


* `waktu_keluar` (Timestamp, Nullable) – Waktu akhir saat kendaraan meninggalkan area parkir.


* `total_bayar` (Integer, Nullable) – Akumulasi biaya parkir yang wajib dibayarkan.


* `status` (Varchar) – Status sirkulasi kendaraan (`aktif` atau `selesai`).


* `user_id` (BigInt, FK -> `users.id`) – Identitas petugas pos yang memproses transaksi.



---

## ❖ BAGIAN 6: PANDUAN INSTALASI DAN PENGEMBANGAN LOKAL

### 6.1 Prasyarat Perangkat Lunak

* PHP ^8.2


* Composer v2


* Node.js & NPM


* DBMS (MySQL, MariaDB, atau PostgreSQL)



### 6.2 Langkah-Langkah Pengaturan Lingkungan (Setup Guide)

1. Unduh atau klon repositori sistem ini ke dalam direktori lokal komputer Anda.


2. Lakukan replikasi fail konfigurasi lingkungan dengan mengeksekusi perintah terminal berikut:


```bash

```



cp .env.example .env

```
3.  Buka fail `.env` menggunakan penyunting teks, kemudian konfigurasikan parameter pangkalan data Anda:
    ```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_parkir_anda
DB_USERNAME=root
DB_PASSWORD=isi_password_mysql_jika_ada

```

4. Jalankan instalasi seluruh pustaka backend PHP yang terdaftar dalam `composer.json`:


```bash

```



composer install

```
5.  Generate kunci enkripsi aplikasi Laravel baru:
    ```bash
php artisan key:generate

```

6. Eksekusi berkas migrasi database untuk menyusun tabel beserta pengisian data awal (*seeder*) otomatis:


```bash

```



php artisan migrate --seed

```
    *Catatan: Proses seeder otomatis memuat cetakan data kendaraan awal melalui `JenisKendaraanSeeder.php`.*
7.  Instal seluruh modul dependensi JavaScript sisi klien:
    ```bash
npm install

```

8. Jalankan proses kompilasi aset frontend menggunakan pustaka Vite:


```bash

```



npm run dev

```
9.  Nyalakan peladen lokal pengembangan aplikasi Laravel:
    ```bash
php artisan serve

```

Aplikasi kini siap diakses melalui peramban pada alamat default peladen `[http://127.0.0.1:8000](http://127.0.0.1:8000)`.

---

## ❖ BAGIAN 7: RENCANA PENGEMBANGAN BERIKUTNYA (FUTURE ROADMAP)

Untuk meningkatkan kapabilitas, akurasi, dan efisiensi sistem perparkiran ini di masa mendatang, arah pengembangan disarankan fokus pada area strategis berikut:

### 7.1 Otomatisasi Pos Masuk Berbasis ALPR (Automatic License Plate Recognition)

* Mengintegrasikan fungsionalitas pengolahan citra (*Computer Vision*) pada pos masuk untuk mendeteksi dan membaca nomor polisi kendaraan secara otomatis dari kamera pengawas. Data plat nomor langsung terinput ke sistem secara instan tanpa memerlukan pengetikan manual oleh petugas.



### 7.2 Integrasi Gerbang Keluar Cashless (E-Money & QRIS API)

* Mengembangkan modul integrasi pembayaran non-tunai menggunakan API gerbang pembayaran (*Payment Gateway*) pihak ketiga. Pengendara dapat melakukan pemindaian kode QRIS dinamis yang muncul pada layar pos keluar atau menempelkan kartu uang elektronik untuk memotong saldo secara otomatis sebelum palang pintu terbuka.



### 7.3 Sinkronisasi IoT Kontrol Perangkat Keras Palang Parkir

* Membangun sub-sistem interseptor berbasis protokol jaringan ringan atau komunikasi serial (seperti NodeMCU/Arduino) yang terhubung langsung dengan sistem backend aplikasi. Ketika status transaksi pada `PosKeluarController` diperbarui menjadi `selesai`, sistem secara otomatis mengirimkan sinyal elektronik untuk mengangkat palang pintu fisik secara mekanis.



### 7.4 Sistem Pemantauan Slot Parkir Kosong (Smart Parking Slot Tracking)

* Menambahkan modul inventarisasi slot parkir statis di dalam menu administrasi, dikombinasikan dengan sensor ultrasonik per slot. Informasi ketersediaan slot yang tersisa dapat ditampilkan secara visual pada halaman beranda utama (`welcome.blade.php`) atau papan digital informasi di gerbang masuk utama.



```***
