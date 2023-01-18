<!-- auth login -->
<?php 
    //cek apakah admin sudah login
    if(!isset($_SESSION['admin'])){
        //jika belum login, alihkan ke halaman login
        $_SESSION['login'] = 'Anda harus login terlebih dahulu';
        header('location:'.SITEURL.'admin/login.php');
    }
?>