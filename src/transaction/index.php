<?php

require_once '../utils.php';
require_once '../repository/TransactionRepository.php';

$repository = new TransactionRepository();
$transactions = $repository->getAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaction List</title>
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
    <h1>Transaction List</h1>
    <a href="create.php">Add New Record</a>
    <br />
    <br />
    <table>
        <tr>
            <th>ID</th>
            <th>Consumer</th>
            <th>Product, Quantity, Price</th>
            <th>Total Price</th>
            <th>Create At</th>
            <th>Action</th>
        </tr>
        <?php foreach ($transactions as $transaction) {
            $total_products = count($transaction->products)
            ?>
            <tr>
                <td><?= $transaction->_id ?></td>
                <td><?= $transaction->consumer_name ?></td>
                <td>
                <?php foreach ($transaction->products as $product) : ?>
                    <?= $product->name. ", ". $product->quantity. " * ". formatRp($product->price). "<br/> " ?>
                <?php endforeach; ?>
                </td>
                <td><?= formatRp($transaction->total_price) ?></td>
                <td><?= epochToHumanDate($transaction->created_at) ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $transaction->_id; ?>">
                        Edit
                    </a>
                    <a style="color: red;" href="delete.php?id=<?php echo $transaction->_id; ?>">
                        Delete
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
