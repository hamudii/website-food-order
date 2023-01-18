<?php include('partials/header.php'); ?>
    <section class="admin edit-admin">
        <div class="container">
            <div class="row mb-1">
                     <div class="col mt-5">
                          <h3 class="text-dark">Update Order Status</h3>
                    </div>
            </div>
            <?php 
                $id = $_GET['id'];
                $sql = "SELECT *,kustomer.nama as nama_kust, o.status as status_order FROM orders o JOIN kustomer ON o.id_kustomer = kustomer.id_kustomer JOIN menu ON o.id_menu = menu.id_menu where o.id_orders = $id";
                // $sql = "SELECT * from kustomer k inner join keranjang on k.id_kustomer = keranjang.id_kustomer inner join orders on keranjang.id_keranjang = orders.id_keranjang";
                $result = mysqli_query($conn, $sql) or die("Query gagal dijalankan: " . mysqli_errno($conn));
                if($result){
                    $data = mysqli_fetch_assoc($result);
                    $nama_kust = $data['nama_kust'];
                    $tgl = $data['tgl'];
                }

            ?>
            <form action="" method="post">
                <table style="width: 40%;">
                    <div class="mb-1 row">
                        <label class="col-sm-5 col-md-2 col-form-label">Order ID</label>
                        <div class="col-sm-3">
                            <label class="col-sm-2 col-form-label"><?php echo $id ?></label>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label class="col-sm-5 col-md-2 col-form-label">Nama Pemesan</label>
                        <div class="col-sm-3">
                            <label class="col-form-label"><?php echo $nama_kust ?></label>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label class="col-sm-5 col-md-2 col-form-label">Tanggal</label>
                        <div class="col-sm-3">
                            <label class="col-form-label"><?php echo $tgl ?></label>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label class="col-sm-5 col-md-2 col-form-label">Status</label>
                        <div class="col-sm-7 col-md-10 col-form-label">
                            <input type="radio" name="status" value="Delivered">
                            <label class="col-sm-3 col-md-1"  >Delivered</label>
                            <input type="radio" name="status" value="On Process" <?php if($data['status_order'] == 'On Process'){echo 'checked';}?>>
                            <label class="col-sm-3 col-md-2" >On Process</label>
                        </div>
                    </div>
                    <tr>
                        <td colspan="2">
                            <input class="btn btn-primary mt-2" type="submit" name="update" value="Update">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </section>
<?php include('partials/footer.php'); ?>

<?php 
    //Check apakah sudah di submit?
    if(isset($_POST['update'])){
        //Ambil data dari form
        $status = $_POST['status'];
        
        //Buat query
        $query = "UPDATE orders SET status='$status' where id_orders='$id'";
        // echo $query;

        //Eksekusi query
        $result = mysqli_query($conn, $query);

        //Cek query
        if($result){
            //Kembali ke halaman index.php
            $_SESSION['update'] = 'Order berhasil diupdate!';            
            echo "<script>window.location='manage-orders.php';</script>";
        }else{
            if(mysqli_errno($conn) == '1062'){
                // die("Query gagal dijalankan: " . mysqli_errno($conn));
                echo "<script>alert('Username telah digunakan');window.location='update-orders.php?id=$id&nama=$nama&tgl=$tgl';</script>";
            } else {
                echo "<script>alert('Failed to insert data<br>');window.location='update-orders.php?id=$id&nama=$nama&tgl=$tgl';</script>";

            }
        }
    }
?>

