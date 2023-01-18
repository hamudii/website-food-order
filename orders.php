<?php include("partials-front/header.php"); ?>

    <!-- Cart START -->
    <section class="cart">
        <div class="container">
            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM menu WHERE id_menu = $id";

                    $result = mysqli_query($conn, $sql);

                    $row = mysqli_fetch_assoc($result);

                    $nama = $row['nama'];
                    $deskripsi = ($row['deskripsi']);
                    $gambar =  ($row['nama_gambar']);
                    $harga = ($row['harga']); 
                }
                else{
                    echo "<script>alert('Pilih menu terlebih dahulu!');window.location='index.php';</script>";
                }
            ?>
            <form action="" method="post" class="order" autocomplete="off">
                <fieldset class="shadow">
                    <legend class="text-center"><strong>Orders</strong></legend>

                    <div class="row">
                        <div class="food-menu-img">
                            <img src="images/menu/<?php echo $gambar; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        </div>
                        <div class="food-menu-desc">
                            <h3><?php echo $nama; ?></h3>
                            <p class="food-price">Rp <?php echo $harga; ?></p>

                            <div class="order-label">Quantity</div>
                            <input type="number" name="qty" class="input-responsive" min="1" value="1" required>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="shadow">
                    <legend>Delivery Details</legend>
                    <div class="order-label">Nama Pemesan</div>
                    <input type="text" name="full-name" placeholder="Cth: Varian Avila" class="input-responsive" required>

                    <div class="order-label">Nomor Telepon</div>
                    <input type="tel" name="contact" placeholder="Cth: 08952306xxxx" class="input-responsive" required>

                    <div class="order-label">Alamat</div>
                    <textarea name="address" rows="4" placeholder="Cth: Jalan, Kelurahan, Kecamatan, Kota" class="input-responsive" required></textarea>
                    <div class="input-group mb-5">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Payment Methods</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="payment">
                            <option value="Transfer Bank" selected>Transfer Bank</option>
                            <option value="COD">Bayar Di Tempat</option>
                            <option value="GoPay">GoPay</option>
                            <option value="Dana">Dana</option>
                            <option value="OVO">OVO</option>
                        </select>
                    </div>
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
            </form>
        </div>
    </section>
<!-- Customer END -->
<?php include('partials-front/footer.php'); ?>

<?php 
    if(isset($_POST['submit'])){
        $nama = $_POST['full-name'];
        $telp = $_POST['contact'];
        $alamat = $_POST['address'];
        $qty = $_POST['qty'];
        $payment = $_POST['payment'];
        $status = "On Process";

        $sql = "INSERT INTO kustomer SET
                nama = '$nama',
                telp = '$telp',
                alamat = '$alamat'";
        $result = mysqli_query($conn, $sql);
        if($result){
            $id_kustomer = mysqli_insert_id($conn);
            $tgl = date('Y-m-d');
            $sql = "INSERT INTO orders SET
                    id_kustomer = '$id_kustomer',
                    id_menu = '$id',
                    quantity = '$qty',
                    tgl = '$tgl',
                    payment = '$payment',
                    status = '$status'";
            $result = mysqli_query($conn, $sql);
            // echo mysqli_error($conn);
            if($result){
                echo "<script>window.location='confirmed-order.php?kustomer=".$id_kustomer."';</script>";
            }
            else{
                echo "<script>alert('Pesanan gagal ditambahkan!');window.location='orders.php?id=".$id."';</script>";
            }
        }
        else{
            echo "<script>alert('Pesanan gagal ditambahkan!');window.location='orders.php?id=".$id."';</script>";
        }
    }
?>