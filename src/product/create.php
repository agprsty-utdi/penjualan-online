<?php

require_once '../utils.php';
require_once '../model/Product.php';
require_once '../repository/ProductRepository.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];

    // Validasi data input 
    if (empty($name) || empty($price) || empty($stock)) {
        $error = "All fields are required.";
        header("Location: create.php?error=" . urlencode($error));
        exit();
    }

    // Buat objek Product baru
    $created_at = now();
    $product = new Product($name, $price, $stock);
    $product->created_at = $created_at;
    $product->updated_at = $created_at;

    // Simpan data konsumen ke dalam repository
    $repository = new ProductRepository();
    $repository->create($product);

    // Redirect ke halaman index atau tampilkan pesan sukses
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Product</title>
</head>

<body>
  <h1>Create Product</h1>

  <?php
    // Tangkap pesan error jika ada
    if (isset($_GET['error'])) {
        $errorMessage = $_GET['error'];
        echo '<p style="color: red;">' . $errorMessage . '</p>';
    }
  ?>

  <form action="create.php" method="POST">
    <table>
      <tr>
        <td>Name</td>
        <td>:</td>
        <td>
          <input type="text" name="name" required>
        </td>
      </tr>
      <tr>
        <td>Stock</td>
        <td>:</td>
        <td>
          <input type="number" name="stock" required>
        </td>
      </tr>
      <tr>
        <td>price</td>
        <td>:</td>
        <td>
          <input type="number" name="price" required>
        </td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td>
          <br>
          <input type="submit" value="Simpan" name="submit">
        </td>
      </tr>
    </table>
  </form>
</body>

</html>