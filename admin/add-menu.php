<?php include('partials/header.php'); ?>
<section class="admin add-menu">
    <div class="container">
        <div class="row mb-1">
            <div class="col mt-5">
                <h3 class="text-dark">Add Menu</h3>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col">
                <?php
                if (isset($_SESSION['upload'])) {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                ?>
                <?php
                if (isset($_SESSION['add'])) {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                ?>
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
        <form action="" method="post" enctype="multipart/form-data">
            <table style="width: 40%;">
                <div class="mb-3 row">
                    <label for="text" class="col-sm-2 col-form-label">Nama menu</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" autocomplete="off" name="new-Nama" placeholder="input nama menu" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputKategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                    <div class="col-sm-3">
                        <select name="new-Kategori">
                            <?php
                            $query = "Select * from kategori";

                            $result = mysqli_query($conn, $query);

                            $count = mysqli_num_rows($result);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id_kategori'];
                                    $namas = $row['nama'];

                            ?>

                                    <option value="<?php echo $id; ?>"><?php echo $namas; ?></option>

                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">Kategori Tidak ditemukan</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-3">
                        <textarea name="new-Deskripsi" cols="30" rows="10" autocomplete="new-Deskripsi" placeholder="input Deskripsi" required></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputGambar" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-3">
                        <input type="file" name="image">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputHarga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" autocomplete="new-Harga" name="new-Harga" placeholder="input Harga" required>
                    </div>
                </div>
                <div class="mb-1 row">
                    <label class="col-sm-5 col-md-2 col-form-label">Status</label>
                    <div class="col-sm-7 col-md-10 col-form-label">
                        <input type="radio" name="status" value="Tersedia">
                        <label class="col-sm-3 col-md-1">Tersedia</label>
                        <input type="radio" name="status" value="Kosong">
                        <label class="col-sm-3 col-md-2">Kosong</label>
                    </div>
                </div>
                <tr>
                    <td colspan="2">
                        <input class="btn btn-primary mt-2" type="submit" name="submit" value="Add Menu">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</section>
<?php include('partials/footer.php'); ?>

<?php
if (isset($_POST['submit'])) {

    $nama = $_POST['new-Nama'];
    $kategori = ($_POST['new-Kategori']);
    $deskripsi = ($_POST['new-Deskripsi']);
    $harga = ($_POST['new-Harga']);
    $status = ($_POST['status']);


    if (isset($_FILES['image'])) {
        $image_name = $_FILES['image']['name'];

        if ($image_name != "") {
            $ext = end(explode('.', $image_name));

            $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext;

            $src = $_FILES['image']['tmp_name'];

            $dst = "../images/menu/" . $image_name;

            $upload = move_uploaded_file($src, $dst);

            if ($upload == false) {
                $_SESSION['upload'] = "<div class= 'error'>Gagal Memasukkan Gambar.</div>";
                echo "<script>window.location='add-menu.php';</script>";
                die();
            }
        }
    } else {
        $image_name = "";
    }

    //Buat query
    $query2 = "INSERT INTO menu SET nama='$nama', id_kategori='$kategori', nama_gambar='$image_name', deskripsi='$deskripsi', harga='$harga', status ='$status'";
    // echo $query2;

    //Eksekusi query
    $result2 = mysqli_query($conn, $query2);

    //Cek query
    if ($result2) {
        //Kembali ke halaman index.php
        $_SESSION['add'] = 'Menu berhasil ditambahkan';
        echo "<script>window.location='manage-menu.php';</script>";
    } else {
        if (mysqli_errno($conn) == '1062') {
            // die("Query gagal dijalankan: " . mysqli_errno($conn));
            $_SESSION['fail'] = 'Nama Menu telah digunakan!';
            echo "<script>window.location='add-menu.php';</script>";
        } else {
            $_SESSION['fail'] = 'Menu gagal ditambahkan';
            echo (mysqli_error($conn));
            // echo "<script>window.location='add-menu.php';</script>";
        }
    }
}
?>