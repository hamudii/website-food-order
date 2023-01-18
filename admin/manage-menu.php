<?php include('partials/header.php'); ?>
        <!-- main START -->
        <section class="admin manage-admin">
            <div class="container">
                <div class="row mb-1">
                    <div class="col mt-5">
                        <h3 class="text-dark">Manage Menu</h3>
                    </div>
                </div>
                <?php
                    if(isset($_SESSION['add'])){
                        echo '
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <h4 class="text-success fs-5"><em>'.$_SESSION['add'].'</em></h4>
                                </div>
                            </div>
                            ';
                        unset($_SESSION['add']);
                    } else if(isset($_SESSION['delete'])){
                        echo '
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <h4 class="text-danger fs-5"><em>'.$_SESSION['delete'].'</em></h4>
                                </div>
                            </div>
                            ';
                        unset($_SESSION['delete']);
                    } else if(isset($_SESSION['edit'])){
                        echo '
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <h4 class="text-success fs-5"><em>'.$_SESSION['edit'].'</em></h4>
                                </div>
                            </div>
                            ';
                        unset($_SESSION['edit']);
                    }
                ?>
                <div class="addMenu">
                    <a href="add-menu.php" class="btn btn-primary mb-2">Add Menu</a>
                </div>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Menu</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //Select data admin dari database
                            $sql = "SELECT *, kategori.nama as nama_kategori, m.nama_gambar as gambar_menu,  m.nama as nama_menu FROM menu m Join kategori On (m.id_kategori = kategori.id_kategori)";
                            //Eksekusi Query
                            $result = mysqli_query($conn, $sql) or die("Query gagal dijalankan: " . mysqli_errno($conn));
                            //Cek query
                            if($result){
                                //hitung banyak baris
                                $row = mysqli_num_rows($result);

                                //Jika ada data
                                if($row > 0){
                                    $number = 1;
                                    //Looping data
                                    while($row= mysqli_fetch_assoc($result)){
                                        // print_r($row);
                                        $id = $row['id_menu'];
                                        $nama= $row['nama_menu'];
                                        $nmKategori = $row['nama_kategori'];
                                        $deskripsi = $row['deskripsi'];
                                        $images = $row['gambar_menu'];
                                        $harga = $row['harga'];
                                        $status = $row['status'];
                                        ?>
                                            <tr>
                                                <td><?php echo $number++;?></td>
                                                <td><?php echo $nama;?></td>
                                                <td><?php echo $nmKategori;?></td>
                                                <td><?php echo $deskripsi;?></td>
                                                <td>
                                                    <?php
                                                        if($images==""){
                                                            echo "<div class='error'>Tidak ada Gambar</div>";
                                                        }
                                                        else{
                                                            ?>
                                                            <img src="<?php echo SITEURL; ?>images/menu/<?php echo $images; ?>" style="width: 100px; height: 100px; object-fit:cover;" >
                                                            <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo $harga;?></td>
                                                <td><?php echo $status;?></td>
                                                <td>
                                                <a href="<?php echo SITEURL; ?>admin/edit-menu.php?id=<?php echo $id;?>" class="btn btn-primary btn-sm btn-success">Edit</a>
                                                <a href="<?php echo SITEURL; ?>admin/delete-menu.php?id=<?php echo $id;?>" class="btn btn-primary btn-sm btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                }else{
                                    echo '<tr>';
                                    echo '<td colspan="8" class="table-danger">Data tidak ditemukan!</td>';
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