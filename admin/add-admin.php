<?php include('partials/header.php'); ?>
<section class="admin add-admin">
    <div class="container">
        <div class="row mb-1">
            <div class="col mt-5">
                <h3 class="text-dark">Admin Data</h3>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col">
                <?php
                if (isset($_SESSION['fail'])) {
                    echo '
                            <h6 class="text-danger">' . $_SESSION['fail'] . '</h6>
                            ';
                    unset($_SESSION['fail']);
                }
                ?>
            </div>
        </div>
        <form action="" method="post">
            <table style="width: 40%;">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" autocomplete="off" name="username" placeholder="input username" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-3">
                        <input type="password" class="form-control" autocomplete="new-password" name="new-password" placeholder="input password" required>
                    </div>
                </div>
                <tr>
                    <td colspan="2">
                        <input class="btn btn-primary mt-2" type="submit" name="submit" value="Add Admin">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</section>
<?php include('partials/footer.php'); ?>

<?php
//Check apakah sudah di submit?
if (isset($_POST['submit'])) {
    //Ambil data dari form
    $username = $_POST['username'];
    $password = ($_POST['new-password']);

    //Buat query
    $query = "INSERT INTO admin SET username='$username', password='$password'";
    // echo $query;

    //Eksekusi query
    $result = mysqli_query($conn, $query);

    //Cek query
    if ($result) {
        //Kembali ke halaman index.php
        $_SESSION['add'] = 'Admin berhasil ditambahkan';
        echo "<script>window.location='manage-admin.php';</script>";
    } else {
        if (mysqli_errno($conn) == '1062') {
            // die("Query gagal dijalankan: " . mysqli_errno($conn));
            $_SESSION['fail'] = 'Username telah digunakan';
            echo "<script>window.location='add-admin.php';</script>";
        } else {
            $_SESSION['fail'] = 'Admin gagal ditambahkan';
            echo "<script>window.location='add-admin.php';</script>";
        }
    }
}
?>