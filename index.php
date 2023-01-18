<?php include("partials-front/header.php"); ?>
<!-- Jumbotron Start -->
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Welcome to Minang Merdeka!</h1>
        <p class="lead">We are the best food ordering website in the world!</p>
        <a href="#categories"><button class="btn btn-primary">Order Now</button></a>
    </div>
</div>
<!-- Jumbotron End -->

<!-- Categories Start -->
<section id="categories" class="categories">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col mb-3">
                <h2 class="text-white">Ingin Pesan Apa Hari ini?</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <?php
            $sql = "SELECT * FROM kategori where statuss = 'Tersedia' ORDER BY id_kategori desc LIMIT 3";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $rows = mysqli_num_rows($result);
                if ($rows > 0) {
                    while ($data = mysqli_fetch_assoc($result)) {
                        echo '
                        <div class="col-md-4 col-sm-6 col-6 mb-3">
                            <a class="card bg-dark" href="categories-menu.php?id='.$data['id_kategori'].'">
                                <img src="images/category/' . $data['nama_gambar'] . '" class="card-img" alt="...">
                                <div class="card-img-overlay">
                                    <div class="title-box m-auto p-md-1 p-sm-1 p-1 rounded bg-light border shadow" >
                                        <h5 class="card-title text-dark"><strong>' . $data['nama'] . '</strong></h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                            ';
                    }
                }
            }
            ?>
        </div>
    </div>
</section>
<!-- Categories End -->

<!-- Menu Start -->
<section class="food-menu">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-center text-dark">Food Menu</h2>
            </div>
        </div>

        <div class="row">
            <?php
            $sql = "SELECT * FROM menu where status = 'Tersedia' ORDER BY id_menu desc LIMIT 6";
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
            }
            ?>
        </div>
    </div>
    </div>

    <p class="text-center">
        <a href="menu.php">
            <h6 class="text-center">See All Menu</h6>
        </a>
    </p>
</section>
<!-- Menu END-->
<?php include('partials-front/footer.php'); ?>