<?php

require_once '../repository/ProductRepository.php';

// Periksa apakah ada parameter ID yang diterima
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $productRepo = new ProductRepository();
    $productRepo->delete($id);

    // Alihkan pengguna kembali ke halaman index.php setelah penghapusan
    header('Location: index.php');
    exit;
}
