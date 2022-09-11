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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FLEXBOX</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Pacifico&display=swap" rel="stylesheet" />
  </head>

  <body>
    <!-- Sidebar -->
    <nav>
      <div class="logo">
        <h4><?php echo $user['nama']; ?></h4>
      </div>
      <ul>
        <li><a href="index.php" style="color:white; font-weight:500;">Dashboard</a></li>
        <li><a href="">Book Data</a></li>
        <li><a href="">Service</a></li>
        <li><a href="">Gallery</a></li>
        <li><a href="">About</a></li>
      </ul>

      <div class="menu-toggle">
        <input type="checkbox" />
        <span></span>
        <span></span>
        <span></span>
      </div>
    </nav>
    <!-- End Sidebar -->

    <!-- Dashboard -->

    <!-- End Dashboard-->
    <script src="../assets/js/script.js"></script>
  </body>
</html>
