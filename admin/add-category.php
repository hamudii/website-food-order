<?php include('partials/header.php'); ?>
<section class="admin add-category">
    <div class="container">
        <div class="row mb-1">
            <div class="col mt-5">
                <h3 class="text-dark">Add Kategori</h3>
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
                } else if (isset($_SESSION['upload'])) {
                    echo '
                            <h6 class="text-danger">' . $_SESSION['upload'] . '</h6>
                            ';
                    unset($_SESSION['upload']);
                }
                ?>
            </div>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <table style="width: 40%;">
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Nama Kategori</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" autocomplete="off" name="nama" placeholder="input nama" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-3">
                        <input type="file" name="image" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-3">
                        <input type="radio" name="Statuss" value="Tersedia"> Tersedia
                        <input type="radio" name="Statuss" value="Kosong"> Kosong
                    </div>
                </div>
                <tr>
                    <td colspan="2">
                        <input class="btn btn-primary mt-2" type="submit" name="submit" value="Add Category">
                    </td>
                </tr>

            </table>
        </form>
        <?php
            //Cek apakah sudah submit
            if (isset($_POST['submit'])) {
                $nama_kategori = $_POST['nama'];

                if(isset($_POST['Statuss'])){
                    $statuss = $_POST['Statuss']; // dari form
                } else{
                    $statuss = "Kosong";
                }

                if(isset($_FILES['image'])){
                    $image_name = $_FILES['image']['name'];

                    //get ext
                    $ext = end(explode(".", $image_name));

                    //rename image name
                    $image_name = "Food_Kategori_".rand(000, 999).".".$ext;


                    $src_path = $_FILES['image']['tmp_name'];
                    $dest_path = "../images/category/".$image_name;
                    $upload = move_uploaded_file($src_path, $dest_path);

                    if(!$upload){
                        $_SESSION['fail'] = "Data gagal ditambahkan".error_log($upload);
                        echo "<script>window.location='add-category.php';</script>";
                        die();
                    }
                }else{
                    $image_name = "";
                }

                $sql = "INSERT INTO kategori SET 
                    nama = '$nama_kategori',
                    nama_gambar = '$image_name',
                    Statuss = '$statuss'";
                // echo $sql;
                $result = mysqli_query($conn, $sql);
                if($result){
                    $_SESSION['add'] = "Data berhasil ditambahkan";
                    echo "<script>window.location='manage-categories.php';</script>";
                } else{
                    $_SESSION['fail'] = "Data gagal ditambahkan".mysqli_error($conn);
                    echo "<script>window.location='add-category.php';</script>";
                }
            }

            
        ?>
    </div>
</section>
<?php include('partials/footer.php'); ?>