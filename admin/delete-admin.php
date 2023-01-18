<?php 
    include('../config/constants.php');
    //Ambil ID admin delete dari URL
    $id = $_GET['id'];

    //Buat query untuk delete
    $sql = "DELETE FROM admin WHERE id_admin = $id";
    //Eksekusi query
    $result = mysqli_query($conn, $sql) or die("Query gagal dijalankan: " . mysqli_errno($conn));
    //Cek query
    if($result){
        
        //Jika berhasil
        $_SESSION['delete'] = 'Admin berhasil dihapus!';
        header("Location: manage-admin.php");
    } else{
        //Jika gagal
        $_SESSION['delete'] = 'Admin gagal dihapus!';
        header("Location: manage-admin.php");
    }

?>