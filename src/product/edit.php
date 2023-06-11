<?php

require_once('../utils.php');
require_once('../model/Product.php');
require_once('../repository/ProductRepository.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];

    $productRepo = new ProductRepository();
    $product = $productRepo->getById($id);

    if ($product) {
        $product->name = $name;
        $product->stock = $stock;
        $product->price = $price;
        $product->updated_at = now();

        $productRepo->update($id, $product);

        // Redirect to index.php after successful update
        header("Location: index.php");
        exit();
    }
} else {
    // Get product ID from query parameter
    $id = $_GET['id'];

    $productRepo = new ProductRepository();
    $product = $productRepo->getById($id);

    if (!$product) {
        // Product not found, redirect to index.php
        header("Location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>

    <form method="POST" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <table>
            <tr>
                <td><label for="name">Name</label></td>
                <td>:</td>
                <td><input type="text" name="name" value="<?php echo $product->name; ?>" required></td>
            </tr>
            <tr>
                <td><label for="stock">Stock:</label></td>
                <td>:</td>
                <td><input type="number" name="stock" value="<?php echo $product->stock; ?>" required></td>
            </tr>
            <tr>
                <td><label for="price">Price:</label></td>
                <td>:</td>
                <td><input type="number" name="price" value="<?php echo $product->price; ?>" required></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" value="Update"></td>
            </tr>
        </table>

        <br>

    </form>
</body>
</html>
