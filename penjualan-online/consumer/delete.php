<?php

require_once 'repository/ConsumerRepository.php';

// Periksa apakah ada parameter ID yang diterima
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $consumerRepo = new ConsumerRepository();
    $consumerRepo->delete($id);

    // Alihkan pengguna kembali ke halaman index.php setelah penghapusan
    header('Location: index.php');
    exit;
}
