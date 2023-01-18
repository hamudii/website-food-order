<?php
    //include constants files
    include('../config/constants.php');

    //echo "Delete Page"
    //check wheter the
    if(isset($_GET['id']))
    {
        //get the value and delete
        //echo "get value and delete";
        $id = $_GET['id'];
        $sql = "SELECT nama_gambar from kategori WHERE id_kategori = $id";
        $res = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($res);

        $Gambar_name = $data['nama_gambar'];
        // echo $Gambar_name;

        //remove the pysical image file is available
        if($Gambar_name != ""){
            //iamge is available. so remove it
            $path = "../images/category/".$Gambar_name;
            //remove the image 
            $remove = unlink($path);

            //if failed to remove image then add an error
            if($remove==false){
                //set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
                //redirect to manage category Page
                echo "<script>window.location='manage-categories.php';</script>";
                //stop the procces
                die();
            }
        }

        //delete data from database
        //sql query to delete data from database
        $sql = "DELETE FROM kategori WHERE id_kategori=$id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check wheter the data is delete from database or not
        if($res==true) 
        {
            //set success message and redirect
            $_SESSION['delete'] = "<div class = 'success'>Category deteled successfully</div>";
            //redirect to manage category category
            echo "<script>window.location='manage-categories.php';</script>";
        }
        else
        {
            //set fail message and redirect
            $_SESSION['delete'] = "<div class = 'error'>Failed to deleted category</div>";
            //redirect to manage category category
            echo "<script>window.location='manage-categories.php';</script>";
        }

        //redirect to manage category page with
    }

    else
    {
        //redirect to manage category page
        echo "<script>window.location='manage-categories.php';</script>";

    }
?>