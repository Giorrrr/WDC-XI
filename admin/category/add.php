<?php

include "../../src/connection.php";

$error = '';
if(isset($_POST['submit'])) {
    $category = strtoupper($_POST["category"]);
    if(checkCategory($connection, $category) == 0)  {
      $sql   = "INSERT INTO category VALUES ('', '$category')";
      $query = mysqli_query($connection, $sql);
      echo "
          <script>
              alert('Data added successfully!');
              window.location.replace('../bookCategory.php');
          </script>
      ";
    } else {
      $error = 'Registered Category Name';
    }
}

function checkCategory($connection, $category) {
  $sql = "SELECT * FROM category WHERE category = '$category' ";
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
  <h3 class="mt-2">Add New Category</h3>
  <hr />
  <a href="../bookCategory.php" class="btn btn-primary mb-3"><i class="bi bi-arrow-bar-left me-2"></i>Back to page</a>
  <form method="post" action="">
    <div class="form-group mb-2">
      <label for="" class="form-label">Category Name</label>
      <input type="text" class="form-control" name="category" placeholder="Category Name">
      <?php if($error != '') : ?>
        <div class="alert alert-danger mt-2" role="alert">
          <?= $error; ?>
        </div>
      <?php endif ?>
    </div>
    <div class="d-grid gap-2">
      <button class="btn btn-primary" type="submit" name="submit">Submit</button>
    </div>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>