<?php include('partials/header.php'); ?>
    <?php
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $sql2 = "SELECT * FROM menu WHERE id_menu = $id";

            $result2 = mysqli_query($conn, $sql2);

            $row2 = mysqli_fetch_assoc($result2);

            $nama = $row2['nama'];
            $kategori = ($row2['id_kategori']); 
            $deskripsi = ($row2['deskripsi']);
            $currentImage =  ($row2['nama_gambar']);
            $harga = ($row2['harga']); 
            $status = ($row2['status']);
        }
        else{
            echo "<script>window.location='manage-menu.php';</script>";
        }
    ?>

    <section class="menu edit-menu">
        <div class="container">
            <div class="row mb-1">
                     <div class="col mt-5">
                          <h3 class="text-dark">Edit Menu</h3>
                    </div>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
            <table style="width: 40%;">
                <div class="mb-3 row">
                    <label for="text" class="col-sm-2 col-form-label">Nama menu</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" autocomplete="off" name="edit-Nama" value="<?php echo $nama; ?>" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputKategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                    <div class="col-sm-3">
                        <select name="edit-Kategori">
                        <?php
                                $query = "Select * from kategori";

                                $result = mysqli_query($conn, $query);

                                $count = mysqli_num_rows($result);

                                if($count > 0){
                                    while($row=mysqli_fetch_assoc($result)){
                                        $id = $row['id_kategori'];
                                        $namas= $row['nama'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $namas; ?></option>

                                        <?php
                                    }
                                }
                                else{
                                    ?>
                                    <option value = "0">Kategori Tidak ditemukan</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-3">
                        <textarea name="edit-Deskripsi" cols="30" rows="10" autocomplete="edit-Deskripsi" placeholder="Masukan Deskripsi" required></textarea> 
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="currentImage" class="col-sm-2 col-form-label">Gambar Saat ini</label>
                    <div class="col-sm-3">
                    <?php
                            if($currentImage == ""){
                                echo "<div class='error'>Gambar Tidak Tersedia</div>";
                            }
                            else{
                                ?>
                                <img src="<?php echo SITEURL; ?>images/menu/<?php echo $currentImage; ?>" width="100px" height="100px">
                                <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputGambar" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-3">
                        <input type="file" name="image" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputHarga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" autocomplete="edit-Harga" name="edit-Harga" value="<?php echo $harga; ?>" required>
                    </div>
                </div>
                <div class="mb-1 row">
                    <label class="col-sm-5 col-md-2 col-form-label">Status</label>
                    <div class="col-sm-7 col-md-10 col-form-label">
                        <input type="radio" name="edit-Status" value="Tersedia">
                        <label class="col-sm-3 col-md-1" >Tersedia</label>
                        <input type="radio" name="edit-Status" value="Kosong">
                        <label class="col-sm-3 col-md-2" >Kosong</label>
                    </div>
                </div>
                <tr>
                    <td colspan="2">
                        <input class="btn btn-primary mt-5" type="submit" name="submit" value="Edit Menu">
                    </td>
                </tr>
            </table>
        </div>
    </section>
<?php include('partials/footer.php'); ?>

<?php 
    //Check apakah sudah di submit?
    if(isset($_POST['submit'])){
        //Ambil data dari form
        $id = $_GET['id'];
        $nama = $_POST['edit-Nama'];
        $kategori = ($_POST['edit-Kategori']); 
        $deskripsi = ($_POST['edit-Deskripsi']); 
        $harga = ($_POST['edit-Harga']); 
        $currentImage = ($row2['nama_gambar']);
        $status = ($_POST['edit-Status']);

        if(isset($_FILES['image'])){
            $image_name = $_FILES['image']['name'];
    
            if($image_name!=""){
                $ext = end(explode('.', $image_name));
    
                $image_name = "Food-Name-".rand(0000,9999).".".$ext;
      
                $src = $_FILES['image']['tmp_name'];
    
                $dst = "../images/menu/".$image_name;
    
                $upload = move_uploaded_file($src, $dst);
    
                if($upload == false){
                    $_SESSION['upload'] = "<div class= 'error'>Gagal Memasukkan Gambar.</div>";
                    echo "<script>window.location='edit-menu.php';</script>";
                    die();
                }
                //remove current image
                if($currentImage != ""){
                    $remove_path = "../images/menu/".$currentImage;
                    $remove = unlink($remove_path);
                }
            } else {
                $image_name = $currentImage;
            }
        }
        else{
            $image_name = $currentImage;
        }
    
        //Buat query
        $query = "UPDATE Menu SET nama='$nama', id_kategori='$kategori', nama_gambar='$image_name', deskripsi='$deskripsi', harga='$harga', status ='$status' where id_menu='$id'";
        echo $query;

        //Eksekusi query
        $result = mysqli_query($conn, $query);

        //Cek query
        if($result){
            //Kembali ke halaman index.php
            $_SESSION['edit'] = 'Menu berhasil diedit';            
            echo "<script>window.location='manage-menu.php';</script>";
        }else{
            if(mysqli_errno($conn) == '1062'){
                // die("Query gagal dijalankan: " . mysqli_errno($conn));
                $_SESSION['fail'] = 'Nama Menu telah digunakan!';
                echo "<script>window.location='edit-admin.php?id=$id';</script>";
            } else {
                $_SESSION['fail'] = 'Menu gagal diedit';
                echo "<script>window.location='edit-admin.php?id=$id';</script>";
            }
        }
    }
?>