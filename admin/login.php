<?php include('../config/constants.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login Admin</title>
</head>

<body>
    <section class="login bg-success" style="height: 93vh;">
        <div class="container h-100">
            <div class="row justify-content-center">
                <div class="col-5 shadow p-5 mt-5 bg-dark" style="border-radius: 1rem;">
                    <h3 class="text-center text-white mb-3">Login Admin</h3>
                    <?php
                    if (isset($_SESSION['error'])) {
                        echo '
                            <h6 class="text-center text-danger">' . $_SESSION['error'] . '</h6>
                            ';
                        unset($_SESSION['error']);
                    } else if (isset($_SESSION['login'])) {
                        echo '
                            <h6 class="text-center text-danger">' . $_SESSION['login'] . '</h6>
                            ';
                        unset($_SESSION['login']);
                    } else {
                        echo '
                            <h6 class="text-center text-dark">-</h6>
                            ';
                    }
                    ?>
                    <form action="" method="POST">
                        <div class="form-group mb-3">
                            <label class="form-label text-white" for="username">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Masukan Username" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label text-white" for="username">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Masukan Password" required>
                        </div>
                        <br>
                        <button type="submit" name="submit" value="login" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="footer bg-dark" style="height: 7vh;">
        <div class="container pt-2">
            <p class="text-white"><small>Proyek UAS Praktikum SisDat I</small></p>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>

<?php
//Check apakah sudah di submit?
if (isset($_POST['submit'])) {
    //Ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];
    //Buat query
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";

    //Eksekusi query
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    //Cek query
    if (mysqli_num_rows($result)) {
        //berhasil
        $_SESSION['login'] = 'Login berhasil';
        $_SESSION['admin'] = $username;
        header('Location:' . SITEURL . 'admin');
    } else {
        //gagal
        $_SESSION['error'] = 'Username/Password salah';
        header('Location:' . SITEURL . 'admin/login.php');
    }
}
?>