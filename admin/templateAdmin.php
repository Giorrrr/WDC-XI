<?php
session_start();
include "../src/connection.php";
$_SESSION['status'] = '';
if(!isset($_SESSION['email'])  && $_SESSION['status'] != "login") {
    echo "
        <script>
            alert('Kamu Belum login!');
            window.location.replace('login.php');
        </script>
    ";
} else {
    $emailUser = $_SESSION['email'];
    $sql = "SELECT * FROM admin WHERE email = '$emailUser' ";
    $query = mysqli_query($connection, $sql);
    $user  = mysqli_fetch_assoc($query);
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
  <title></title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container">
    <a class="navbar-brand" href="index.php"><?php echo $user['nama']; ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Master
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="class.php">Class</a></li>
            <li><a class="dropdown-item" href="student.php">Student</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="bookCategory.php">Book Category</a></li>
            <li><a class="dropdown-item" href="book.php">Book</a></li>
          </ul>
        </li>
      </ul>
      <a href="../auth/logout.php" class="btn btn-primary d-block d-lg-none">Logout</a>
    </div>
    <a href="../auth/logout.php" class="btn btn-primary d-none d-lg-block">Logout</a>
  </div>
</nav>

<div class="container">
  <h3 class="mt-2"></h3>
  <hr />
  <a href="" class="btn btn-primary mb-3"><i class="bi bi-plus fw-bolder fs-5 me-1"></i>Tambah Data</a>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <td>
        <a href="?id=<?= $result["id"]; ?>" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
        <a href="?id=<?= $result["id"]; ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
      </td>
    </tbody>
  </table>  
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>
