<?php include('partials/header.php'); ?>
    <section class="admin edit-admin">
        <div class="container">
            <div class="row mb-1">
                     <div class="col mt-5">
                          <h3 class="text-dark">Edit Admin Data</h3>
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
    if(isset($_POST['submit'])){
        //Ambil data dari form
        $id = $_GET['id'];
        $username = $_POST['username'];
        $password = ($_POST['new-password']); 
        
        //Buat query
        $query = "UPDATE admin SET username='$username', password='$password' where id_admin='$id'";
        // echo $query;

        //Eksekusi query
        $result = mysqli_query($conn, $query);

        //Cek query
        if($result){
            //Kembali ke halaman index.php
            $_SESSION['edit'] = 'Admin berhasil diedit';            
            echo "<script>window.location='manage-admin.php';</script>";
        }else{
            if(mysqli_errno($conn) == '1062'){
                // die("Query gagal dijalankan: " . mysqli_errno($conn));
                echo "<script>alert('Username telah digunakan');window.location='edit-admin.php?id=$id';</script>";
            } else {
                echo "<script>alert('Failed to insert data<br>');window.location='edit-admin.php?id=$id';</script>";

            }
        }
    }
?>

