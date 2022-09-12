<?php
session_start();
include "../src/connection.php";
$_SESSION['status'] = '';
if(!isset($_SESSION['email'])  && $_SESSION['status'] != "login") {
    echo "
        <script>
            alert('Kamu Belum login!');
            window.location.replace('../auth/login.php');
        </script>
    ";
} else {
    $emailUser = $_SESSION['email'];
    $sql = "SELECT * FROM admin WHERE email = '$emailUser' ";
    $query = mysqli_query($connection, $sql);
    $user  = mysqli_fetch_assoc($query);
    // print_r($user);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <title>Home</title>
</head>
<body>
    <div class="text-center">
        <h1>Home</h1>
        <img src="../assets/img/wdc.jpg" alt="gamabr TI" class="rounded-circle m-2 mb-3" style="width: 100px;">
        <!-- <p>Selamat datang, <?php echo ($_SESSION["email"]) ?></p> -->
        <p>Selamat datang, <span class="fw-bold"><?php echo $user['nama']; ?></span></p>
        <a href="../auth/logout.php" class="btn btn-primary">Logout</a>
    </div>
</body>
</html>