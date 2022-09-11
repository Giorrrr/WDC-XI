<?php
session_start();

include "connection.php";
$email = $_POST['email'];
$password = md5($_POST['password']);
$data = mysqli_query($connection, "SELECT * FROM siswa WHERE email ='$email' AND password ='$password'");
var_dump($data);
$cek = mysqli_num_rows($data);

if ($cek > 0) {
    $_SESSION['email'] = $email;
    $_SESSION['status'] = "login";
    header("location:admin/index.php");
} else {
    header("location:login.php");
}