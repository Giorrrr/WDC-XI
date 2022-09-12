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
    $sql = "SELECT * FROM siswa WHERE email = '$emailUser' ";
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

  <title>Dashboard</title>
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
    </div>
  </div>
</nav>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>
