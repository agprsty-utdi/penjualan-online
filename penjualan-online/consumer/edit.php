<?php

require_once('../utils.php');
require_once('repository/ConsumerRepository.php');
require_once('model/Consumer.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $gender = $_POST['gender'];

    $consumerRepo = new ConsumerRepository();
    $consumer = $consumerRepo->getById($id);

    if ($consumer) {
        $consumer->name = $name;
        $consumer->email = $email;
        $consumer->address = $address;
        $consumer->phone_number = $phone_number;
        $consumer->gender = $gender;
        $consumer->updated_at = now();

        $consumerRepo->update($id, $consumer);

        // Redirect to index.php after successful update
        header("Location: index.php");
        exit();
    }
} else {
    // Get consumer ID from query parameter
    $id = $_GET['id'];

    $consumerRepo = new ConsumerRepository();
    $consumer = $consumerRepo->getById($id);

    if (!$consumer) {
        // Consumer not found, redirect to index.php
        header("Location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Consumer</title>
    <style>
        /* table {
            width: 100%;
        } */
        /* table td {
            padding: 5px;
        }
        table td label {
            font-weight: bold;
            display: inline-block;
            width: 150px;
        } */
    </style>
</head>
<body>
    <h1>Edit Consumer</h1>

    <form method="POST" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <table>
            <tr>
                <td><label for="name">Name</label></td>
                <td>:</td>
                <td><input type="text" name="name" value="<?php echo $consumer->name; ?>" required></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td>:</td>
                <td><input type="email" name="email" value="<?php echo $consumer->email; ?>" required></td>
            </tr>
            <tr>
                <td><label for="phone_number">Phone Number:</label></td>
                <td>:</td>
                <td><input type="text" name="phone_number" value="<?php echo $consumer->phone_number; ?>" required></td>
            </tr>
            <tr>
                <td><label for="gender">Gender:</label></td>
                <td>:</td>
                <td>
                    <select name="gender" required>
                        <option value="0" <?php echo ($consumer->gender === 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="1" <?php echo ($consumer->gender === 'Female') ? 'selected' : ''; ?>>Female</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="address">Address:</label></td>
                <td>:</td>
                <td><textarea name="address" rows="3" ><?php echo $consumer->address; ?></textarea></td>
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
