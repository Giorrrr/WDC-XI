<?php
include "../../src/connection.php";

$_SESSION['status'] = '';
if(!isset($_SESSION['email'])  && $_SESSION['status'] != "login") {
    echo "
        <script>
            alert('Kamu Belum login!');
            window.location.replace('../../auth/login.php');
        </script>
    ";
} else {
    $emailUser = $_SESSION['email'];
    $sql = "SELECT * FROM admin WHERE email = '$emailUser' ";
    $query = mysqli_query($connection, $sql);
    $user  = mysqli_fetch_assoc($query);
}

$id = $_GET["id"];
$sql = "DELETE FROM class WHERE id = '$id' ";
$delete = mysqli_query($connection, $sql);

echo "
    <script>
        alert('Data deleted successfully!');
        window.location.replace('../class.php');
    </script>
";