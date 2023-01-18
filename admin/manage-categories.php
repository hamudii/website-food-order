<?php include('partials/header.php'); ?>

<!-- Main Start -->
<section class="admin manage-admin">
    <div class="container">
        <div class="row mb-1">
            <div class="col mt-5">
                <h3 class="text-dark">Manage Categories</h3>
            </div>
        </div>
        <?php
        if (isset($_SESSION['add'])) {
            echo '
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <h4 class="text-success fs-5"><em>' . $_SESSION['add'] . '</em></h4>
                                </div>
                            </div>
                            ';
            unset($_SESSION['add']);
        } else if (isset($_SESSION['delete'])) {
            echo '
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <h4 class="text-danger fs-5"><em>' . $_SESSION['delete'] . '</em></h4>
                                </div>
                            </div>
                            ';
            unset($_SESSION['delete']);
        } else if (isset($_SESSION['edit'])) {
            echo '
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <h4 class="text-success fs-5"><em>' . $_SESSION['edit'] . '</em></h4>
                                </div>
                            </div>
                            ';
            unset($_SESSION['edit']);
        } else if (isset($_SESSION['remove'])) {
            echo '
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <h4 class="text-success fs-5"><em>' . $_SESSION['remove'] . '</em></h4>
                                </div>
                            </div>
                            ';
            unset($_SESSION['remove']);
        }
        ?>
        <div class="addCategory">
            <a href="add-category.php" class="btn btn-primary mb-2">Add Category</a>
        </div>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Kategori</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //Select data admin dari database
                $sql = "SELECT * FROM kategori";
                //Eksekusi Query
                $result = mysqli_query($conn, $sql) or die("Query gagal dijalankan: " . mysqli_errno($conn));
                //Cek query
                if ($result) {
                    //hitung banyak baris
                    $row = mysqli_num_rows($result);

                    //Jika ada data
                    if ($row > 0) {
                        $number = 1;
                        //Looping data
                        while ($data = mysqli_fetch_assoc($result)) {
                            $Gambar_name = $data['nama_gambar'];
                            echo '
                                <tr>
                                    <th scope="row">' . $number++ . '</th>
                                    <td>' . $data['nama'] . '</td>
                                    <td>'; ?>
                            <?php
                            //check wheter image name is available or not
                            if ($Gambar_name != "") {
                                //display image name
                            ?>
                                <img src="../images/category/<?php echo $Gambar_name; ?>" style="width: 100px; height: 100px; object-fit:cover;">
                            <?php
                            } else {
                                //display message
                                echo '<div class = "error">Image not added</div>';
                            }
                            ?>
<<<<<<< HEAD
                <?php echo '
                                        
                                    </td>
                                    
                                    <td>' . $data['Statuss'] . '</td>
                                    <td>
                                        <a href="update-category.php?id=' . $data['id_kategori'] . '" class="btn btn-primary btn-sm btn-success">Update category</a>
                                        <a href="delete-category.php?id=' . $data['id_kategori'] . '" class="btn btn-primary btn-sm btn-danger">Delete category</a>
                                    </td>
                                </tr>';
                        }
                    } else {
                        echo '<tr>';
                        echo '<td colspan="4" class="table-danger">Data tidak ditemukan!</td>';
=======
                            <?php echo '
                                        
                                </td>
                                
                                <td>' . $data['statuss'] . '</td>
                                <td>
                                    <a href="update-category.php?id=' . $data['id_kategori'] . '" class="btn btn-primary btn-sm btn-success">Update category</a>
                                    <a href="delete-category.php?id=' . $data['id_kategori'] . '" class="btn btn-primary btn-sm btn-danger">Delete category</a>
                                </td>
                            </tr>';
                        }
                    } else {
                        echo '<tr>';
                        echo '<td colspan="5" class="table-danger">Data tidak ditemukan!</td>';
>>>>>>> 9a0a1dc3c0e4430dfeef1a58639604b4fa392ff7
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<!-- main END -->
<?php include('partials/footer.php'); ?>