<?php

include "../src/connection.php";

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // default validation
    $inputEmail   = stripslashes($_POST["email"]);
    $inputEmail   = mysqli_real_escape_string($connection, $inputEmail);
    $inputPwd     = stripslashes($_POST["password"]);
    $inputPwd     = mysqli_real_escape_string($connection, $inputPwd);
    $inputPwdHash = md5($inputPwd);

    session_start();

    if(checkEmail($inputEmail, $connection) != 0) {
        // $sql = "SELECT * FROM siswa WHERE email = '$inputEmail'";
        $sql = "SELECT * FROM admin WHERE email ='$inputEmail' AND password ='$inputPwdHash'";
        $dataSiswa = mysqli_query($connection, $sql);
        $cek = mysqli_num_rows($dataSiswa);
        if ($cek > 0) {
            $_SESSION['email'] = $inputEmail;
            $_SESSION['status'] = "login";
            echo "
                <script>
                    alert('Login Berhasil!');
                    window.location.replace('../admin/index.php');
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Login Gagal. Password tidak valid');
                    window.location.replace('login.php');
                </script>
            ";
        }
    } else {
        $error = 'Email tidak terdaftar!';
    }
}
function checkEmail($inputEmail, $connection){
    $emailDB = mysqli_real_escape_string($connection, $inputEmail);
    $query = "SELECT * FROM admin WHERE email = '$emailDB' ";
    if( $result = mysqli_query($connection, $query) ) return mysqli_num_rows($result);
}

// $kolom = mysqli_fetch_assoc($dataSiswa);
// $kunciEmail = "caca@gmail.com";
// $kunciPwd = "caca123";

// session_start();

// if ($inputEmail == $kolom["email"]) {
//     // $verifikasiPass = password_verify($inputPwd, $kolom["password"]);
    
//     if($verifikasiPass == true){
//         $_SESSION["email"] = $inputEmail;
//         echo "
//             <script>
//                 alert('Login Berhasil!');
//                 window.location.replace('home.php');
//             </script>
//         ";
//     } else {
//         echo "
//             <script>
//                 alert('Login Gagal!');
//                 window.location.replace('login.php');
//             </script>
//         ";
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <title>Sign-In</title>
</head>
<body class="bg-secondary">
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-4">
                <div class="d-flex justify-content-center">
                    <img src="../assets/img/wdc.jpg" alt="logo" class="mb-3" style="width: 120px;">
                </div>
                <div class="bg-white p-3">
                    <h2 class="text-center">Sign-In</h2>
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <!-- <form method="POST" action="proses-login.php"> -->
                        <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Input Email" required>
                        <?php if($error != '') : ?>
                            <div class="alert alert-danger mt-2" role="alert">
                                <?= $error; ?>
                            </div>
                        <?php endif ?>
                        </div>
                        <div class="form-group mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Input Password" required>
                        </div>
                        <div class="d-grid gap-2 mb-3">
                            <input type="submit" name="tombolSubmit" value="Sign-In" class="btn btn-primary">
                        </div>
                    </form>
                    <div class="text-center">
                        <p>Don't have account? <a href="register.php" class="text-decoration-none fw-bold text-primary">Sign-Up</a></p>
                        <p>or Forgot Password? <a href="forget.php" class="text-decoration-none fw-bold text-primary">Reset Password</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>