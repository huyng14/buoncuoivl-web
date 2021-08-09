<?php 
    session_start();
    if(isset($_SESSION['admin_buoncuoi'])){
        session_destroy();
        header('location:login.php');
    }
    echo 'Day la trang logout';

?>