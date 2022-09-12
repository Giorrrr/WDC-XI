<?php 
include "../../src/connection.php";

$id = $_GET["id"];
$sql = "SELECT * FROM class WHERE id = '$id' ";
$query = mysqli_query($connection, $sql);
$data  = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <title></title>
</head>
<body>
<div class="container">
  <h3 class="mt-2">Edit Page</h3>
  <hr />
  <a href="../class.php" class="btn btn-primary mb-3"><i class="bi bi-arrow-bar-left me-2"></i>Back to page</a>
  <form method="post" action="">
    <div class="form-group mb-2">
      <label for="" class="form-label">Class Name</label>
      <input type="text" class="form-control" name="class" value="<?= $data[1]; ?>" >
    </div>
    <div class="d-grid gap-2">
      <button class="btn btn-primary" type="submit" name="submit">Submit</button>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>

<?php
if(isset($_POST['submit'])) {
  $class = $_POST["class"];
  $update = mysqli_query($connection, "UPDATE class SET class = '$class' WHERE id = '$id' ");
  echo "
    <script>
      alert('Data changed successfully!');
      window.location.replace('../class.php');
    </script>
  ";
}
?>