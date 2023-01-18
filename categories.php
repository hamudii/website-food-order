<?php include("partials-front/header.php"); ?>

<!-- Categories Start -->
<section class="categories bg-white">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col mb-3">
                <h2>Categories</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <?php
            $sql = "SELECT * FROM kategori";
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
<?php include("partials-front/footer.php"); ?>