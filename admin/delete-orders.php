<?php 
    include('../config/constants.php');
    //Ambil ID admin delete dari URL
    $id = $_GET['id'];

    //ambil id kustomer terus hapus juga
    $sql = "SELECT * FROM orders WHERE id_orders = $id";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $data = mysqli_fetch_assoc($result);
    $id_kustomer = $data['id_kustomer'];

    //hapus customer
    $sql = "DELETE FROM kustomer WHERE id_kustomer = $id_kustomer";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    //Buat query untuk delete order 
    $sql = "DELETE FROM orders WHERE id_orders = $id";
    //Eksekusi query
    $result = mysqli_query($conn, $sql) or die("Query gagal dijalankan: " . mysqli_errno($conn));
    //Cek query
    if($result){
        
        //Jika berhasil
        $_SESSION['delete'] = 'Order berhasil dihapus!';
        header('location:'.SITEURL.'admin/manage-orders.php');
    } else{
        //Jika gagal
        $_SESSION['delete'] = 'Order gagal dihapus!';
        header('location:'.SITEURL.'admin/manage-orders.php');
    }
?>