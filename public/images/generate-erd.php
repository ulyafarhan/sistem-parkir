<?php
// Membuat gambar ERD untuk sistem parkir
$width = 1200;
$height = 900;

// Membuat gambar baru
$image = imagecreatetruecolor($width, $height);

// Warna
$white = imagecolorallocate($image, 248, 250, 252);  // #f8fafc
$black = imagecolorallocate($image, 30, 41, 59);    // #1e293b
$blue = imagecolorallocate($image, 59, 130, 246);     // #3b82f6
$lightBlue = imagecolorallocate($image, 219, 234, 254); // #dbeafe
$green = imagecolorallocate($image, 34, 197, 94);     // #22c55e
$lightGreen = imagecolorallocate($image, 220, 252, 231); // #dcfce7
$purple = imagecolorallocate($image, 168, 85, 247);   // #a855f7
$lightPurple = imagecolorallocate($image, 243, 232, 255); // #f3e8ff
$gray = imagecolorallocate($image, 100, 116, 139);   // #64748b
$red = imagecolorallocate($image, 220, 38, 38);       // #dc2626

// Background
imagefilledrectangle($image, 0, 0, $width, $height, $white);

// Judul
$font = 5; // Font built-in PHP (1-5)
imagestring($image, 5, 350, 20, 'Entity Relationship Diagram - Sistem Parkir QR Code', $black);

// Tabel Users (x=50, y=100)
imagefilledrectangle($image, 50, 100, 350, 450, $lightBlue);
imagerectangle($image, 50, 100, 350, 450, $blue);
imagefilledrectangle($image, 50, 100, 350, 150, $blue);
imagestring($image, 5, 180, 120, 'users', $white);

// Atribut Users
imagestring($image, 3, 60, 170, 'id (PK) - BIGINT, AUTO_INCREMENT', $black);
imagestring($image, 3, 60, 195, 'name - VARCHAR(255)', $black);
imagestring($image, 3, 60, 220, 'email - VARCHAR(255), UNIQUE', $black);
imagestring($image, 3, 60, 245, 'password - VARCHAR(255)', $black);
imagestring($image, 3, 60, 270, 'role - ENUM("admin", "operator")', $black);
imagestring($image, 3, 60, 295, 'shift - VARCHAR(50)', $black);
imagestring($image, 3, 60, 320, 'created_at - TIMESTAMP', $gray);
imagestring($image, 3, 60, 345, 'updated_at - TIMESTAMP', $gray);
imagestring($image, 3, 60, 370, 'deleted_at - TIMESTAMP (nullable)', $gray);

// Tabel Jenis Kendaraan (x=850, y=100)
imagefilledrectangle($image, 850, 100, 1150, 380, $lightGreen);
imagerectangle($image, 850, 100, 1150, 380, $green);
imagefilledrectangle($image, 850, 100, 1150, 150, $green);
imagestring($image, 5, 920, 120, 'jenis_kendaraan', $white);

// Atribut Jenis Kendaraan
imagestring($image, 3, 860, 170, 'id (PK) - BIGINT, AUTO_INCREMENT', $black);
imagestring($image, 3, 860, 195, 'nama_kendaraan - VARCHAR(100)', $black);
imagestring($image, 3, 860, 220, 'tarif_per_jam - DECIMAL(10,2)', $black);
imagestring($image, 3, 860, 245, 'tarif_per_hari - DECIMAL(10,2)', $black);
imagestring($image, 3, 860, 270, 'created_at - TIMESTAMP', $gray);
imagestring($image, 3, 860, 295, 'updated_at - TIMESTAMP', $gray);
imagestring($image, 3, 860, 320, 'deleted_at - TIMESTAMP (nullable)', $gray);

// Tabel Transaksi (x=450, y=500)
imagefilledrectangle($image, 450, 500, 750, 850, $lightPurple);
imagerectangle($image, 450, 500, 750, 850, $purple);
imagefilledrectangle($image, 450, 500, 750, 550, $purple);
imagestring($image, 5, 580, 520, 'transaksi', $white);

// Atribut Transaksi
imagestring($image, 3, 460, 570, 'id (PK) - BIGINT, AUTO_INCREMENT', $black);
imagestring($image, 3, 460, 595, 'qr_code - VARCHAR(255), UNIQUE', $black);
imagestring($image, 3, 460, 620, 'jenis_kendaraan_id (FK) - BIGINT', $red);
imagestring($image, 3, 460, 645, 'plat_nomor - VARCHAR(20)', $black);
imagestring($image, 3, 460, 670, 'jam_masuk - DATETIME', $black);
imagestring($image, 3, 460, 695, 'jam_keluar - DATETIME (nullable)', $black);
imagestring($image, 3, 460, 720, 'tarif - DECIMAL(10,2)', $black);
imagestring($image, 3, 460, 745, 'user_id (FK) - BIGINT', $red);
imagestring($image, 3, 460, 770, 'created_at - TIMESTAMP', $gray);
imagestring($image, 3, 460, 795, 'updated_at - TIMESTAMP', $gray);

// Relasi Users ke Transaksi (One to Many)
// Garis vertikal dari users ke tengah
imageline($image, 200, 450, 200, 500, $black);
// Garis horizontal ke transaksi
imageline($image, 200, 500, 600, 500, $black);
// Garis vertikal ke transaksi
imageline($image, 600, 500, 600, 500, $black);

// Notasi crow's foot (1 ke N)
// Sisi "1" (di users)
imagestring($image, 3, 180, 460, '1', $black);
// Sisi "N" (di transaksi)
imagestring($image, 3, 580, 485, 'N', $black);
// Crow's foot lines
imageline($image, 580, 490, 600, 500, $black);
imageline($image, 580, 510, 600, 500, $black);

// Relasi Jenis Kendaraan ke Transaksi (One to Many)
// Garis vertikal dari jenis_kendaraan ke tengah
imageline($image, 1000, 380, 1000, 500, $black);
// Garis horizontal ke transaksi
imageline($image, 1000, 500, 750, 500, $black);

// Notasi crow's foot (1 ke N)
// Sisi "1" (di jenis_kendaraan)
imagestring($image, 3, 980, 390, '1', $black);
// Sisi "N" (di transaksi)
imagestring($image, 3, 770, 485, 'N', $black);
// Crow's foot lines
imageline($image, 770, 490, 750, 500, $black);
imageline($image, 770, 510, 750, 500, $black);

// Legend
imagefilledrectangle($image, 50, 750, 400, 870, $white);
imagerectangle($image, 50, 750, 400, 870, $gray);
imagestring($image, 4, 60, 760, 'Legend:', $black);
imagestring($image, 3, 60, 780, 'Merah: Foreign Key (Kunci Asing)', $red);
imagestring($image, 3, 60, 800, 'Abu-abu: Timestamp (Waktu)', $gray);
imagestring($image, 3, 60, 820, 'Hitam: Field/Atribut Biasa', $black);
imagestring($image, 3, 60, 840, '1:N = One to Many Relationship', $black);

// Output gambar
header('Content-Type: image/png');
imagepng($image);

// Simpan juga ke file
imagepng($image, 'erd-sistem-parkir.png');

// Hapus memori
imagedestroy($image);
?>