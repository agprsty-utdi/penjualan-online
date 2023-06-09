## Instalasi Menggunakan Docker

Dokumen ini memberikan langkah-langkah untuk menginstal dan menjalankan aplikasi Penjualan Online menggunakan docker.

### Persyaratan Sistem

Pastikan sistem Anda memenuhi persyaratan berikut sebelum melanjutkan:

- Docker telah terinstal dan berjalan di mesin Anda.

### Langkah-langkah Instalasi

1. Clone repositori ini ke direktori lokal Anda:
```bash
git clone https://github.com/agprsty-utdi/penjualan-online.git
```

2. Pindah ke direktori proyek "penjualan-online":
```bash
cd penjualan-online
```

3. Salin file `.config/config.php.example` ke `.config/config.php`:
```bash
cp .config/config.php.example .config/config.php

edit .config/config.php pada key `host` dengan nilai `mongo`
```

4. execute the following command

```bash
docker compose up -d --build
```

5. Jika proses sudah selesai dan berhasil, maka buka laman [http://localhost](http://localhost).