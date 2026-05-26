# Cara Menambahkan Gambar ERD ke Website

## Lokasi File

1. **Upload gambar ERD** ke folder: `c:\laragon\www\sistem-parkir\public\images\`
2. **Nama file yang disarankan**: `erd-sistem-parkir.png`
3. **Format yang didukung**: PNG, JPG, JPEG, SVG

**Catatan**: File SVG sangat disarankan karena dapat diskalakan tanpa kehilangan kualitas dan ukuran file biasanya lebih kecil.

### Contoh ERD (Tersedia)
Beberapa file contoh ERD telah tersedia:

1. **`erd-sistem-parkir.svg`** - File SVG sederhana (800x600px)
2. **`erd-sistem-parkir-large.svg`** - File SVG versi besar (1200x900px)
3. **`generate-erd-png.html`** - Generator PNG (buka di browser untuk download PNG)
4. **`generate-erd.php`** - Script PHP untuk generate PNG (membutuhkan PHP dengan GD)

#### Cara Menggunakan Generator PNG:
1. Buka file `generate-erd-png.html` di browser
2. Klik tombol "Download PNG" 
3. File `erd-sistem-parkir.png` akan terdownload otomatis

#### Tools untuk Convert SVG ke PNG:
- Adobe Illustrator
- Inkscape (gratis & open source)
- Online converter (svg2png.com, cloudconvert.com)
- Browser (buka SVG, lalu screenshot/save as)

## Metode Upload

### Metode 1: Copy File Langsung
1. Copy file gambar ERD Anda
2. Paste ke folder: `c:\laragon\www\sistem-parkir\public\images\`
3. Rename menjadi `erd-sistem-parkir.png`

### Metode 2: Drag and Drop via Browser
1. Buka website di browser
2. Scroll ke bagian ERD Section
3. Klik area upload (kotak putus-putus)
4. Pilih file gambar ERD dari komputer Anda
5. Gambar akan otomatis tampil dan tersimpan

## Spesifikasi Gambar yang Direkomendasikan

- **Ukuran**: 1200x800px atau proporsional
- **Format**: PNG (disarankan untuk kualitas terbaik)
- **Ukuran file**: Maksimal 5MB
- **Background**: Putih atau transparan

## Isi ERD yang Harus Ada

Pastikan gambar ERD Anda menampilkan:

1. **Tabel users** dengan kolom:
   - id (PK)
   - name
   - email
   - password
   - role
   - shift
   - created_at
   - updated_at

2. **Tabel jenis_kendaraan** dengan kolom:
   - id (PK)
   - nama_kendaraan
   - tarif_per_jam
   - tarif_per_hari
   - created_at
   - updated_at

3. **Tabel transaksi** dengan kolom:
   - id (PK)
   - qr_code
   - jenis_kendaraan_id (FK)
   - plat_nomor
   - jam_masuk
   - jam_keluar
   - tarif
   - user_id (FK)
   - created_at
   - updated_at

4. **Relasi**:
   - users → transaksi (One to Many)
   - jenis_kendaraan → transaksi (One to Many)

## Tools yang Bisa Digunakan

- **dbdiagram.io** (online, gratis)
- **draw.io** (online, gratis)
- **MySQL Workbench** (desktop)
- **Lucidchart** (online)
- **Figma** (online, dengan plugin database)

## Contoh Struktur Relasi

```
users (1) ----< (N) transaksi (N) >---- (1) jenis_kendaraan
```

## Troubleshooting

### Gambar tidak muncul?
1. Periksa format file (harus PNG/JPG/JPEG)
2. Periksa ukuran file (maksimal 5MB)
3. Refresh halaman browser
4. Clear cache browser (Ctrl+F5)

### Upload gagal?
1. Pastikan file tidak rusak
2. Coba format lain (PNG ke JPG atau sebaliknya)
3. Periksa permission folder `public/images`

### Gambar terlalu besar?
1. Kompres gambar menggunakan tool online
2. Ubah ukuran menjadi 1200x800px
3. Gunakan format PNG untuk kualitas terbaik

## Fitur yang Tersedia

- ✅ Upload gambar dengan klik
- ✅ Drag and drop support
- ✅ Validasi format file
- ✅ Validasi ukuran file
- ✅ Preview gambar otomatis
- ✅ Simpan ke localStorage
- ✅ Tombol ganti gambar
- ✅ Tombol hapus gambar
- ✅ Responsive design

## Catatan Penting

- Gambar akan tersimpan di browser (localStorage) untuk akses offline
- Untuk mengganti gambar, klik tombol "Ganti Gambar"
- Untuk menghapus gambar, klik tombol "Hapus Gambar"
- Gambar akan hilang jika clear browser data