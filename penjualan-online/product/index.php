<?php

require_once '../utils.php';
require_once '../repository/ProductRepository.php';

$repository = new ProductRepository();
$products = $repository->getAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border: 1px solid black;
        }

        a {
            text-decoration: none !important;
        }
    </style>
</head>
<body>
    <h1>Product List</h1>
    <a href="create.php">Add New Record</a>
    <br />
    <br />
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Create At</th>
            <th>Action</th>
        </tr>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td><?= $product->_id ?></td>
                <td><?= $product->name ?></td>
                <td><?= formatRp($product->price) ?></td>
                <td><?= $product->stock ?></td>
                <td><?= epochToHumanDate($product->created_at) ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $product->_id; ?>">
                        Edit
                    </a>
                    <a style="color: red;" href="delete.php?id=<?php echo $product->_id; ?>">
                        Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
