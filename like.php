<?php

//require_once 'app/init.php';
include 'config/connect.php';

if(isset($_GET['type']))
{
//    $db = new PDO("mysql:host=localhost; dbname=buoncuoi","root","");

    $type = $_GET['type'];
    $mabv = (int)$_GET['ma_bai_viet'];
    //$mabv = $_SESSION['maUser'];
    switch ($type){
        case 'baiviet':
            
            
            
            $count_like=$db->exec("
                INSERT INTO thich (ma_user, ma_bai_viet)
                SELECT {$_COOKIE['ma_user']}, {$mabv}
                FROM bai_viet
                WHERE EXISTS (
                    SELECT ma_bai_viet
                    FROM bai_viet
                    WHERE ma_bai_viet = {$mabv})
                AND NOT EXISTS (
                    SELECT *
                    FROM thich
                    WHERE ma_user = {$_COOKIE['ma_user']}
                        AND ma_bai_viet = {$mabv})
                LIMIT 1
            ");
            if($count_like){
                $query= "UPDATE thich
                    SET like_dislike=1
                    WHERE ma_user = {$_COOKIE['ma_user']}
                        AND ma_bai_viet = {$mabv}";
                $db->exec($query); 
            }
            else {
               $db->exec("
                        DELETE FROM thich
                        WHERE ma_user = {$_COOKIE['ma_user']}
                                AND ma_bai_viet = {$mabv}
                                    
                    ");
            }
             header("location:index.php#".$mabv);              
            break;
            
        case 'danhmuc':
            $madm = $_GET['ma_danh_muc'];
            $count_like=$db->exec("
                INSERT INTO thich (ma_user, ma_bai_viet)
                SELECT {$_COOKIE['ma_user']}, {$mabv}
                FROM bai_viet
                WHERE EXISTS (
                    SELECT ma_bai_viet
                    FROM bai_viet
                    WHERE ma_bai_viet = {$mabv})
                AND NOT EXISTS (
                    SELECT *
                    FROM thich
                    WHERE ma_user = {$_COOKIE['ma_user']}
                        AND ma_bai_viet = {$mabv})
                LIMIT 1
            ");
            if($count_like){
                $query= "UPDATE thich
                    SET like_dislike=1
                    WHERE ma_user = {$_COOKIE['ma_user']}
                        AND ma_bai_viet = {$mabv}";
                $db->exec($query); 
            }
            else {
               $db->exec("
                        DELETE FROM thich
                        WHERE ma_user = {$_COOKIE['ma_user']}
                                AND ma_bai_viet = {$mabv}
                                    
                    ");
            }
             header("location:index.php?page=danh_muc&ma_danh_muc=".$madm);   
             break;
            
            
    }
}
//header("location:index.php#".$mabv);
?>
