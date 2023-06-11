## Instalasi Menggunakan HTDOCS

Dokumen ini memberikan langkah-langkah untuk menginstal dan menjalankan aplikasi Penjualan Online menggunakan htdocs.

### Persyaratan Sistem

Pastikan sistem Anda memenuhi persyaratan berikut sebelum melanjutkan:

- PHP telah terinstal di mesin Anda.
- PHPMYADMIN telah terinstal dan berjalan di mesin Anda.
- MongoDB telah terinstal dan berjalan di mesin Anda.
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

3. Salin seluruh file yang berada dalam direktori `src` 
  
4. Kemudian pergi ke dalam direktori `HTDOCS` anda, buat direktori baru bernama `penjualan-online` jika sudah. Taruh seluruh file yang sebelumnya di salin masukkan kedalam direktori `penjualan-online`

5. Salin file `.config/config.php.example` ke `.config/config.php`:
```bash
cp .config/config.php.example .config/config.php
```

6. Sesuaikan `config/config.php` dengan environment MongoDB anda

7. Jalankan perintah berikut untuk menginstal dependensi proyek:
```bash
composer install
```

8. Jalankan perintah berikut untuk mentrigger file autoload pada dependensi proyek:
```bash
composer dump-autoload --optimize
```

9. Jika proses sudah selesai dan berhasil, maka buka laman [http://localhost](http://localhost).
