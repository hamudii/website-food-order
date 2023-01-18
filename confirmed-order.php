<?php include("partials-front/header.php"); ?>
<?php
if (isset($_GET['kustomer'])) {
    $id = $_GET['kustomer'];

    $sql = "SELECT *,kustomer.nama as nama_kust, menu.nama as nama_menu FROM orders o JOIN kustomer ON o.id_kustomer = kustomer.id_kustomer JOIN menu ON o.id_menu = menu.id_menu WHERE o.id_kustomer = $id;";

    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);

    $id_order = $data['id_orders'];
    $tgl_order = $data['tgl'];
    $nama_kust = $data['nama_kust'];
    $alamat = $data['alamat'];
    $payment = $data['payment'];
    $nama_gambar = $data['nama_gambar'];
    $nama_menu = $data['nama_menu'];
    $harga = $data['harga'];
    $quantity = $data['quantity'];
    $total = $quantity * $harga;
} else {
    echo "<script>alert('Pilih menu terlebih dahulu!');window.location='index.php';</script>";
}
?>
<!-- Order START -->
<section class="confirmed-order">
    <div class="container">
        <form action="#" class="order" autocomplete="off">
            <fieldset class="shadow">
                <legend class="text-center">Order Details</legend>

                <legend><strong>Pemesan</strong></legend>
                <div class="container">
                    <div class="row ">
                        <div class="col-4">
                            <p><strong>No. Order</strong></p>
                        </div>
                        <div class="col-8">
                            <p><?php echo $id_order; ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-4">
                            <p><strong>Tanggal</strong></p>
                        </div>
                        <div class="col-8">
                            <p><?php echo $tgl_order; ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-4">
                            <p><strong>Nama Pesanan</strong></p>
                        </div>
                        <div class="col-8">
                            <p><?php echo $nama_kust; ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-4">
                            <p><strong>Alamat</strong></p>
                        </div>
                        <div class="col-8">
                            <p><?php echo $alamat; ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-4">
                            <p><strong>Metode Pembayaran</strong></p>
                        </div>
                        <div class="col-8">
                            <p><?php echo $payment; ?></p>
                        </div>
                    </div>
                </div>

                <legend class="mt-4"><strong>Orders</strong></legend>
                <div class="container">

                    <div class="row justify-content-end">
                        <div class="food-menu-img">
                            <img src="images/menu/<?php echo $nama_gambar; ?>" alt="<?php echo $nama_menu; ?>" class="img-responsive img-curve">
                        </div>
                        <div class="food-menu-desc mb-5 ms-5">
                            <h5><?php echo $nama_menu; ?></h5>
                            <div class="price">
                                <p class="food-price"><?php echo $quantity.' x Rp '. $harga ?></p>
                                <p class="total-food-price"><?php echo $total; ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row total mt-3">
                        <div class="col-8">
                            <h5 class="text-center">Total</h5>
                        </div>
                        <div class="col-4">
                            <h5 class="text-end">Rp <?php echo $total; ?></h5>
                        </div>
                    </div>
                    <div class="row pesan mt-5 mb-3">
                        <h4 class="text-center"><em>"Silahkan duduk manis dan tunggu pesanan anda!"</em></h4>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</section>
<!-- Customer END -->
<?php include("partials-front/footer.php"); ?>