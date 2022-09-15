<?php
include "../../src/connection.php";

$sql         = "SELECT * FROM class";
$query       = mysqli_query($connection, $sql);
$errorNis    = '';
$errorPhone  = '';

if(isset($_POST['submit'])) {
    $kelas    = $_POST["kelas"];
    $nis      = $_POST["nis"];
    $name     = $_POST["name"];
    $phone    = $_POST["phone"];
    $alamat   = $_POST["alamat"];

    if(checkNis($connection, $nis) == 0 && strlen($nis) == 4) {
      if(checkPhone($connection, $phone) == 0 && strlen($phone) >= 10 && strlen($phone) <= 15) {
        $sql = "INSERT INTO student VALUES ('', '$kelas', '$nis', '$name', '$alamat', '$phone')";
        $query = mysqli_query($connection, $sql);
        echo "
            <script>
                alert('Data added successfully!');
                window.location.replace('../student.php');
            </script>
        ";
      } else {
        $errorPhone = 'Data Input Invalid';
      }
    } else {
      $errorNis = 'Data Input Invalid';
    }
}

function checkNis($connection, $nis) {
  $sql = "SELECT * FROM student WHERE nis = '$nis' ";
  if( $result = mysqli_query($connection, $sql) ) return mysqli_num_rows($result);
}

function checkPhone($connection, $phone) {
  $sql = "SELECT * FROM student WHERE telepon = '$phone' ";
  if( $result = mysqli_query($connection, $sql) ) return mysqli_num_rows($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <title>ADD</title>
</head>
<body>

<div class="container">
  <h3 class="mt-2">Add New Student</h3>
  <hr />
  <a href="../student.php" class="btn btn-primary mb-3"><i class="bi bi-arrow-bar-left me-2"></i>Back to page</a>
  <form method="post" action="">
    <div class="form-group mb-2">
      <label for="" class="form-label">Kelas</label>
      <select class="form-select" aria-label="Default select example" name="kelas" >
        <?php while ($result = mysqli_fetch_array($query)) : ?>
            <option value="<?= $result["id"]; ?>"><?= $result["kelas"]; ?></option>
          <?php endwhile; ?>
      </select>
    </div>
    <div class="form-group mb-2">
      <label for="" class="form-label">NIS</label>
      <input type="text" class="form-control" name="nis" placeholder="1234" onkeypress="return inputNumber(event)">
      <?php if($errorNis != '') : ?>
        <div class="alert alert-danger mt-2" role="alert">
          <?= $errorNis; ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="form-group mb-2">
      <label for="" class="form-label">Name</label>
      <input type="text" class="form-control" name="name" placeholder="Sandhika Galih" required>
    </div>
    <div class="form-group mb-2">
      <label for="" class="form-label">Phone</label>
      <input type="text" class="form-control" name="phone" placeholder="081234567890" onkeypress="return inputNumber(event)">
      <?php if($errorPhone != '') : ?>
        <div class="alert alert-danger mt-2" role="alert">
          <?= $errorPhone; ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="form-group mb-2">
      <label for="" class="form-label">Address</label>
      <textarea name="alamat" cols="30" rows="5" class="form-control" required></textarea>
    </div>
    <div class="d-grid gap-2">
      <button class="btn btn-primary" type="submit" name="submit">Submit</button>
    </div>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script src="../../assets/js/main.js"></script>
</body>
</html>