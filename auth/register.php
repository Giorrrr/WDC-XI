<?php
include "../src/connection.php";

$errorPwd = '';
$errorEmail = '';
$errorUser = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // default validation
    $nama = stripslashes($_POST["nama"]);
    $nama = mysqli_real_escape_string($connection, $nama);
    $user = stripslashes($_POST["user"]);
    $user = mysqli_real_escape_string($connection, $user);
    $email = stripslashes($_POST["email"]);
    $email = mysqli_real_escape_string($connection, $email);
    $pwd = stripslashes($_POST["password"]);
    $pwd = mysqli_real_escape_string($connection, $pwd);
    $pwd2 = stripslashes($_POST["password2"]);
    $pwd2 = mysqli_real_escape_string($connection, $pwd2);

    // password validation
    $uppercase     = preg_match('@[A-Z]@', $pwd);
    $lowercase     = preg_match('@[a-z]@', $pwd);
    $number        = preg_match('@[0-9]@', $pwd);
    // $uppercase2    = preg_match('@[A-Z]@', $pwd2);
    // $lowercase2    = preg_match('@[a-z]@', $pwd2);
    // $number2       = preg_match('@[0-9]@', $pwd2);

    if (!$uppercase || !$lowercase || !$number || strlen($pwd) < 8 ) {
        $errorPwd = 'Password should be at least 8 characters in length and should include at least one upper case letter and one number.';
    } else {
        if($pwd == $pwd2) {
            // $hashpass = password_hash($pwd, PASSWORD_DEFAULT);

            if(checkEmail($email, $connection) == 0){
                if(checkUser($user, $connection) == 0) {
                    $hashpass = md5($pwd);

                    $insertQuery = "INSERT INTO siswa(nama, email, username, password, status) VALUES ('$nama', '$email', '$user', '$hashpass', '1')";
                    $result = mysqli_query($connection, $insertQuery);

                    echo "
                        <script>
                            alert('Pendaftaran berhasil! Silahkan login.');
                            window.location.replace('login.php');
                        </script>
                    ";
                } else {
                    $errorUser = 'Username sudah terdaftar!';
                    // echo "
                    //     <script>
                    //         alert('Pendaftaran Gagal. Username sudah terdaftar!');
                    //         window.location.replace('register.php');
                    //     </script>
                    // ";
                }
                
            } else {
                $errorEmail = 'Email sudah terdaftar!';
                // echo "
                //     <script>
                //         alert('Pendaftaran Gagal. Email sudah terdaftar!');
                //         window.location.replace('register.php');
                //     </script>
                // ";
            }
            
        } else {
            echo "
                <script>
                    alert('Pendaftaran Gagal. Masukkan password yang sama!');
                    window.location.replace('register.php');
                </script>
            ";
        }
    }
}

function checkEmail($email, $connection){
    $emailDB = mysqli_real_escape_string($connection, $email);
    $query = "SELECT * FROM siswa WHERE email = '$emailDB' ";
    if( $result = mysqli_query($connection, $query) ) return mysqli_num_rows($result);
}

function checkUser($user,$connection){
    $userDB = mysqli_real_escape_string($connection, $user);
    $query = "SELECT * FROM siswa WHERE username = '$userDB' ";
    if( $result = mysqli_query($connection, $query) ) return mysqli_num_rows($result);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <title>Sign-Up</title>
</head>
<body class="bg-secondary">
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-4">
                <div class="d-flex justify-content-center">
                    <img src="../assets/img/wdc.jpg" alt="logo" class="mb-3" style="width: 120px;">
                </div>
                <div class="bg-white p-3">
                    <h2 class="text-center">Sign-Up</h2>
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Input Name" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="user" class="form-control" placeholder="Input Username" required>
                                    <?php if($errorUser != '') : ?>
                                        <div class="alert alert-danger mt-2" role="alert">
                                            <?= $errorUser; ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Input Email" required>
                            <?php if($errorEmail != '') : ?>
                                <div class="alert alert-danger mt-2" role="alert">
                                    <?= $errorEmail; ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Input Password" required>
                            <?php if($errorPwd != '') : ?>
                                <div class="alert alert-danger mt-2" role="alert">
                                    <?= $errorPwd; ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="password2" placeholder="Input Confirm Password" required>
                        </div>
                        <div class="d-grid gap-2 mb-3">
                            <input type="submit" name="tombolSubmit" value="Sign-Up" class="btn btn-primary">
                        </div>
                    </form>
                    <div class="text-center">
                        <p>Already have an account? <a href="login.php" class="text-decoration-none fw-bold text-primary">Sign-In</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
