<?php

require_once 'model/Consumer.php';
require_once 'repository/ConsumerRepository.php';
require_once '../utils.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['phoneNumber'];
    $gender = $_POST['gender'];

    // Validasi data input 
    if (empty($name) || empty($email) || empty($address) || empty($phoneNumber)) {
        $error = "All fields are required.";
        header("Location: create.php?error=" . urlencode($error));
        exit();
    }

    // Buat objek Consumer baru
    $created_at = now();
    $consumer = new Consumer($name, $email, $address, $phoneNumber, $gender);
    $consumer->created_at = $created_at;
    $consumer->updated_at = $created_at;

    // Simpan data konsumen ke dalam repository
    $repository = new ConsumerRepository();
    $repository->create($consumer);

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
  <title>Create Consumer</title>
</head>

<body>
  <h1>Create Consumer</h1>

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
        <td>email</td>
        <td>:</td>
        <td>
          <input type="email" name="email" required>
        </td>
      </tr>
      <tr>
        <td>Phone Number</td>
        <td>:</td>
        <td>
          <input type="tel" name="phoneNumber" required>
        </td>
      </tr>
      <tr>
        <td>Gender</td>
        <td>:</td>
        <td>
          <select name="gender">
            <option value="0">Male</option>
            <option value="1">Famale</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Address</td>
        <td>:</td>
        <td>
          <textarea name="address" rows="3" required></textarea>
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