<?php 
    session_start();
    if(isset($_COOKIE['admin_buoncuoi'])){
        setcookie('admin_buoncuoi', "", time()-3600);
        setcookie('ma_user', "",  time()-3600);
        setcookie('tenUser', "", time()-3600);
    }
    header('location:index.php');
    echo 'Day la trang logout';

?>