<?php include('partials/header.php'); ?>

<div class="admin main-content">
    <div class="container">
        <div class="row mb-1">
            <div class="col mt-5">
                <h3 class="text-dark">Update Kategori</h3>
            </div>
        </div>

        <?php
<<<<<<< HEAD
            //check whether the id is set or not
            if(isset($_GET['id']))
            {
                //getthe id and all other details
                $id = $_GET['id'];
                //create sql query to get all other details
                $sql = "SELECT * FROM kategori WHERE id_kategori = $id";
=======
        //check whether the id is set or not
        if (isset($_GET['id'])) {
            //getthe id and all other details
            $id = $_GET['id'];
            //create sql query to get all other details
            $sql = "SELECT * FROM kategori WHERE id_kategori = $id";
>>>>>>> 9a0a1dc3c0e4430dfeef1a58639604b4fa392ff7

            //execute the Query
            $res = mysqli_query($conn, $sql);

            //count the rows to check whether the id is valid or not
            $count = mysqli_num_rows($res);

<<<<<<< HEAD
                if($count ==1){
                    //getallthe data
                    $data = mysqli_fetch_assoc($res);
                    $NamaKategori = $data['nama'];
                    $current_Gambar = $data['nama_gambar'];
                    $Statuss = $data['Statuss'];
                }
                else
                {
                    //redirect to manage category with session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not found</div>";
                    echo "<script>window.location='manage-categories.php';</script>";
                }
            }
            else
            {
                //redirect to manage category
=======
            if ($count == 1) {
                //getallthe data
                $data = mysqli_fetch_assoc($res);
                $NamaKategori = $data['nama'];
                $current_Gambar = $data['nama_gambar'];
                $Statuss = $data['Statuss'];
            } else {
                //redirect to manage category with session message
                $_SESSION['no-category-found'] = "<div class='error'>Category not found</div>";
>>>>>>> 9a0a1dc3c0e4430dfeef1a58639604b4fa392ff7
                echo "<script>window.location='manage-categories.php';</script>";
            }
        } else {
            //redirect to manage category
            echo "<script>window.location='manage-categories.php';</script>";
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
<<<<<<< HEAD
            <table class="tbl-30">
                <tr>
                    <td>Nama Kategori : </td>
                    <td>
                        <input type="text" name="nama" value="<?php echo $NamaKategori; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Gambar Sebelumnya : </td>
                    <td>
                        <?php
                            if($current_Gambar != "")
                            {
                                $Gambar_name = $data['nama_gambar'];
                                //Display the image
                                ?>
                                    <img src="../images/category/<?php echo $Gambar_name; ?>" style="width: 100px; height: 100px; object-fit:cover;">
=======
            <table style="width: 40%;">
                <div class="mb-3 row">
                    <label for="text" class="col-sm-2 col-form-label">Nama Kategori</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" autocomplete="off" name="nama" value="<?php echo $NamaKategori; ?>" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="currentImage" class="col-sm-2 col-form-label">Gambar Saat ini</label>
                    <div class="col-sm-3">
                    <?php
                            if($current_Gambar == ""){
                                echo "<div class='error'>Gambar Tidak Tersedia</div>";
                            }
                            else{
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_Gambar; ?>" width="100px" height="100px">
>>>>>>> 9a0a1dc3c0e4430dfeef1a58639604b4fa392ff7
                                <?php
                            }
                        ?>
                    </div>
                </div>

<<<<<<< HEAD
                <tr>
                    <td>Gambar Baru : </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Statuss :</td>
                    <td>
                        <input <?php if($Statuss=="Tersedia") {echo "checked";} ?> type="radio" name="Statuss" value="Tersedia"> Tersedia
                        <input <?php if($Statuss=="Kosong") {echo "checked";} ?> type="radio" name="Statuss" value="Kosong"> Kosong
                    </td>
                </tr>
=======
                <div class="mb-3 row">
                    <label for="inputGambar" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-3">
                        <input type="file" name="image" >
                    </div>
                </div>

                <div class="mb-1 row">
                    <label class="col-sm-5 col-md-2 col-form-label">Status</label>
                    <div class="col-sm-7 col-md-10 col-form-label">
                    <input <?php if ($Statuss == "Tersedia") {
                                    echo "checked";
                                } ?> type="radio" name="Statuss" value="Tersedia">
                        <label class="col-sm-3 col-md-1" >Tersedia</label>
                        <input <?php if ($Statuss == "Kosong") {
                                    echo "checked";
                                } ?> type="radio" name="Statuss" value="Kosong">
                        <label class="col-sm-3 col-md-2" >Kosong</label>
                    </div>
                </div>
>>>>>>> 9a0a1dc3c0e4430dfeef1a58639604b4fa392ff7

                <tr>
                    <td>
                        <input type="hidden" name="current_Gambar" value="<?php echo $current_Gambar; ?>">
                        <input type="hidden" name="id_kategori" values="<?php echo $id; ?>">
                        <input class="btn btn-primary mt-2" type="submit" name="submit" value="Update Kategori">
                    </td>
                </tr>
            </table>
        </form>

        <?php
<<<<<<< HEAD
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //1. Get all the values from our form and
                $id = $_GET['id'];
                $nama = $_POST['nama'];
                $current_Gambar = $_POST['current_Gambar'];
                $Statuss = $_POST['Statuss'];

                //2. Updating new image if selected
                //check whether the image selected or not
                if(isset($_FILES['image']['name']))
                {
                    //get the image details 
                    $Gambar_name = $_FILES['image']['name'];
=======
        if (isset($_POST['submit'])) {
            //echo "Clicked";
            //1. Get all the values from our form and
            $id = $_GET['id'];
            $nama = $_POST['nama'];
            $current_Gambar = $_POST['current_Gambar'];
            $Statuss = $_POST['Statuss'];

            //2. Updating new image if selected
            //check whether the image selected or not
            if (isset($_FILES['image']['name'])) {
                //get the image details 
                $Gambar_name = $_FILES['image']['name'];
>>>>>>> 9a0a1dc3c0e4430dfeef1a58639604b4fa392ff7

                //check whether the image available or not
                if ($Gambar_name != "") {
                    //image available
                    //A. upload the new image

                    //Auto rename our image
                    //Get the extention of our image(jpg, png, gif, etc) e.g "Specialfood.jpg"
                    $ext = end(explode('.', $Gambar_name));

                    //Rename the image
                    $Gambar_name = "Food_Category_" . rand(000, 999) . '.' . $ext; //e.g. Food_Category_034.jpg

<<<<<<< HEAD
                        $source_path = $_FILES['image']['tmp_name'];
=======
                    $source_path = $_FILES['image']['tmp_name'];
>>>>>>> 9a0a1dc3c0e4430dfeef1a58639604b4fa392ff7

                    $destination_path = "../images/category/" . $Gambar_name;

                    //Finally upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

<<<<<<< HEAD
                        //Check whether the images uploaded or not
                        //And if the imge is not uploaded than we will stop the process and redirect witg error message

                        if($upload==false){
                            //Set message
                            $_SESSION['upload'] = "<div class='error'>Uploading images failed</div>";
                            //Redirect to add category page
                            echo "<script>window.location='manage-categories.php';</script>";
                            //Stop process
                            die();
                        }
                        //B. remove the curent image if it available
                        if($current_Gambar != "")
                        {
                            $remove_path = "../images/category/". $current_Gambar;
                            $remove = unlink($remove_path);
    
                            //check whether the image is removed or not
                            //if failed to remove then display error message and stop the message
                            if($remove ==false)
                            {
                                //failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                                echo "<script>window.location='manage-categories.php';</script>";
                                die(); //stop this process
                            }
                        }
=======
                    //Check whether the images uploaded or not
                    //And if the imge is not uploaded than we will stop the process and redirect witg error message
>>>>>>> 9a0a1dc3c0e4430dfeef1a58639604b4fa392ff7

                    if ($upload == false) {
                        //Set message
                        $_SESSION['upload'] = "<div class='error'>Uploading images failed</div>";
                        //Redirect to add category page
                        echo "<script>window.location='manage-categories.php';</script>";
                        //Stop process
                        die();
                    }
                    //B. remove the curent image if it available
                    if ($current_Gambar != "") {
                        $remove_path = "../images/category/" . $current_Gambar;
                        $remove = unlink($remove_path);

                        //check whether the image is removed or not
                        //if failed to remove then display error message and stop the message
                        if ($remove == false) {
                            //failed to remove image
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                            echo "<script>window.location='manage-categories.php';</script>";
                            die(); //stop this process
                        }
                    }
                } else {
                    $Gambar_name = $current_Gambar;
                }
            } else {
                $Gambar_name = $current_Gambar;
            }

<<<<<<< HEAD
                //3. Update the database 
                $sql2 = "UPDATE kategori SET
=======
            //3. Update the database 
            $sql2 = "UPDATE kategori SET
>>>>>>> 9a0a1dc3c0e4430dfeef1a58639604b4fa392ff7
                    nama = '$nama',
                    nama_gambar = '$Gambar_name',
                    Statuss = '$Statuss'
                    Where id_kategori=$id
                ";

            //execute the Query
            $res2 = mysqli_query($conn, $sql2);

<<<<<<< HEAD
                //4. Redirect to manage category with message
                //check wheter executed or not
                if($res2==true)
                {
                    //category upload
                    $_SESSION['update'] = "<div class = 'success'>Category update successfully</div>";
                    echo "<script>window.location='manage-categories.php';</script>";
                }
                else
                {
                    $_SESSION['update'] = "<div class = 'error'>failed to update catergory </div>";
                    echo "<script>window.location='add-categories.php';</script>";
                }
=======
            //4. Redirect to manage category with message
            //check wheter executed or not
            if ($res2 == true) {
                //category upload
                $_SESSION['update'] = "<div class = 'success'>Category update successfully</div>";
                echo "<script>window.location='manage-categories.php';</script>";
            } else {
                $_SESSION['update'] = "<div class = 'error'>failed to update catergory </div>";
                echo "<script>window.location='add-categories.php';</script>";
>>>>>>> 9a0a1dc3c0e4430dfeef1a58639604b4fa392ff7
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>