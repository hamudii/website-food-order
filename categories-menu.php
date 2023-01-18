<?php include("partials-front/header.php"); ?>


<!-- Categories Start -->
<section class="categories bg-white">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col mb-3">
                <?php
                $id = $_GET['id'];
                $sql = "SELECT * FROM kategori WHERE id_kategori = $id";
                $result = mysqli_query($conn, $sql);
                $data = mysqli_fetch_assoc($result);
                if ($data) {
                    echo '<h2>Kategori: ' . $data['nama'] . '</h2>';
                } else {
                    echo '<h2 class="text-danger"><em?>Kategori tidak ditemukan!</em></h2>';
                }
                ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <?php
            $sql = "SELECT * FROM kategori INNER JOIN menu on menu.id_kategori = kategori.id_kategori WHERE kategori.id_kategori = $id AND menu.status = 'Tersedia'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $rows = mysqli_num_rows($result);
                if ($rows > 0) {
                    while ($data = mysqli_fetch_assoc($result)) {
                        echo '
                        <div class="col-md-6">
                            <div class="food-menu-box shadow p-3 mb-5">
                                <div class="food-menu-img">
                                    <img src="images/menu/' . $data['nama_gambar'] . '" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                </div>

                                <div class="food-menu-desc">
                                    <h4>' . $data['nama'] . '</h4>
                                    <p class="food-price">Rp. ' . $data['harga'] . '</p>
                                    <p class="food-detail mb-5">' . $data['deskripsi'] . '</p>
                                    <a href="orders.php?id='.$data['id_menu'].'" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        </div>
                            ';
                    }
                } else {
                    echo '<h2 class="text-danger text-center"><em>Menu tidak ditemukan!</em></h2>';
                }
            } else {
                echo 'Kategori tidak ditemukan!';
            }
            ?>
        </div>
    </div>
</section>
<!-- Categories End -->
<?php include("partials-front/footer.php"); ?>