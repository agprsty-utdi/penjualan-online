<?php

require_once '../utils.php';
require_once 'repository/ConsumerRepository.php';

$repository = new ConsumerRepository();
$consumers = $repository->getAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Consumer List</title>
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
    <h1>Consumer List</h1>
    <a href="create.php">Add New Record</a>
    <br />
    <br />
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Gender</th>
            <th>Create At</th>
            <th>Action</th>
        </tr>
        <?php foreach ($consumers as $consumer) : ?>
            <tr>
                <td><?= $consumer->_id ?></td>
                <td><?= $consumer->name ?></td>
                <td><?= $consumer->email ?></td>
                <td><?= $consumer->address ?></td>
                <td><?= $consumer->phone_number ?></td>
                <td><?= $consumer->gender ? "Female" : "Male"; ?></td>
                <td><?= epochToHumanDate($consumer->created_at) ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $consumer->_id; ?>">
                        Edit
                    </a>
                    <a style="color: red;" href="delete.php?id=<?php echo $consumer->_id; ?>">
                        Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
