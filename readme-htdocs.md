## Instalasi Menggunakan HTDOCS

Dokumen ini memberikan langkah-langkah untuk menginstal dan menjalankan aplikasi Penjualan Online menggunakan htdocs.

### Persyaratan Sistem

Pastikan sistem Anda memenuhi persyaratan berikut sebelum melanjutkan:

- PHPMYADMIN telah terinstal dan berjalan di mesin Anda.
- PHP telah terinstal di mesin Anda.
- Komposer (Composer) telah terinstal di mesin Anda.

### Langkah-langkah Instalasi

1. Clone repositori ini ke direktori lokal Anda:
```bash
git clone https://github.com/agprsty-utdi/penjualan-online.git
```

2. Pindah ke direktori proyek "penjualan-online":
```bash
cd penjualan-online
```

3. Pindahkan direktori proyek `penjualan-online` ke dalam program `HTDOCS` anda. 

4. Salin file `.config/config.php.example` ke `.config/config.php`:
```bash
cp .config/config.php.example .config/config.php
```

5. Sesuaikan config dengan environment MongoDB anda!

6. Jalankan perintah Composer untuk menginstal dependensi proyek:
```bash
composer install
```

7. Jika proses sudah selesai dan berhasil, maka buka laman [http://localhost](http://localhost).
