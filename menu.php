<?php include('partials-front/header.php'); ?>
    <!-- Menu Start -->
    <section class="mainContent food-menu">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="text-center text-dark">Food Menu</h2>
                </div>
            </div>

            <div class="row">
            <?php
            $sql = "SELECT * FROM menu where status = 'Tersedia' LIMIT 6";
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
                }
            } else{
                echo "Menu Tidak Tersedia!";
            }
            ?>
            </div>
        </div>
    </section>
    <!-- Menu END-->
<?php include('partials-front/footer.php'); ?>