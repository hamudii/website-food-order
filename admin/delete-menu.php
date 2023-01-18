<?php 
    include('../config/constants.php');
    //Ambil ID admin delete dari URL
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT nama_gambar from menu WHERE id_menu = $id";
        $res = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($res);
        $Gambar_name = $data['nama_gambar'];

        if($Gambar_name != ""){
            //iamge is available. so remove it
            $path = "../images/menu/".$Gambar_name;
            //remove the image 
            $remove = unlink($path);

            //if failed to remove image then add an error
            if($remove==false){
                //set the session message
                $_SESSION['delete'] = "<div class='error'>Failed to remove category image.</div>";
                //redirect to manage category Page
                echo "<script>window.location='manage-menu.php';</script>";
                //stop the procces
                die();
            }
        }

        //Buat query untuk delete
        $sql = "DELETE FROM menu WHERE id_menu = $id";
        //Eksekusi query
        $result = mysqli_query($conn, $sql) or die("Query gagal dijalankan: " . mysqli_errno($conn));
        //Cek query
        if($result){
            
            //Jika berhasil
            $_SESSION['delete'] = 'Menu berhasil dihapus!';
            header("Location: manage-menu.php");
        } else{
            //Jika gagal
            $_SESSION['delete'] = 'Menu gagal dihapus!';
            header("Location: manage-menu.php");
        }
    }
    

?>