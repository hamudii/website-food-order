<?php
    //ambil session dari login (constants.php)
    include('../config/constants.php');

    //hapus semua session
    session_destroy();

    //balik ke menu login
    header('location:'.SITEURL.'admin/login.php');
?>