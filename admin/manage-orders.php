<?php include('partials/header.php'); ?>
        <!-- main START -->
        <section class="admin manage-orders">
            <div class="container">
                <div class="row mb-1">
                    <div class="col mt-5">
                          <h3 class="text-dark">Manage Orders</h3>
                    </div>
                </div>
                <?php
                   if(isset($_SESSION['update'])){
                        echo '
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <h4 class="text-success fs-5"><em>'.$_SESSION['update'].'</em></h4>
                                </div>
                            </div>
                            ';
                        unset($_SESSION['update']);
                    } else if(isset($_SESSION['delete'])){
                        echo '
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <h4 class="text-danger fs-5"><em>'.$_SESSION['delete'].'</em></h4>
                                </div>
                            </div>
                            ';
                        unset($_SESSION['delete']);
                    }
                ?>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Pemesan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //Select data admin dari database
                            $sql = "SELECT *,kustomer.nama as nama_kust, o.status as status_order FROM orders o JOIN kustomer ON o.id_kustomer = kustomer.id_kustomer JOIN menu ON o.id_menu = menu.id_menu";

                            //Eksekusi Query
                            $result = mysqli_query($conn, $sql) or die("Query gagal dijalankan: " . mysqli_errno($conn));
                            //Cek query
                            if($result){
                                //hitung banyak baris
                                $row = mysqli_num_rows($result);

                                //Jika ada data
                                if($row > 0){
                                    //Looping data
                                    while($data = mysqli_fetch_assoc($result)){
                                        echo '
                                            <tr>
                                                <td scope="row">'.$data['id_orders'].'</td>
                                                <td>'.$data['nama_kust'].'</td>
                                                <td>'.$data['tgl'].'</td>
                                                <td>'.$data['status_order'].'</td>
                                                <td>
                                                    <a href="update-orders.php?id='.$data['id_orders'].'" class="btn btn-primary btn-sm btn-success">Update Orders</a>
                                                    <a href="delete-orders.php?id='.$data['id_orders'].'" class="btn btn-primary btn-sm btn-danger">Delete Orders</a>
                                                </td>
                                            </tr>';}
                                }else{
                                    echo '<tr>';
                                    echo '<td colspan="5" class="table-danger">Data tidak ditemukan!</td>';
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
