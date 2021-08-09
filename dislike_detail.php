<?php

//require_once 'app/init.php';
include 'config/connect.php';
session_start();
if(isset($_GET['type'], $_GET['ma_bai_viet']))
{
//    $db = new PDO("mysql:host=localhost; dbname=buoncuoi","root","");

    $type = $_GET['type'];
    $mabv = (int)$_GET['ma_bai_viet'];
    //$mabv = $_SESSION['maUser'];
    switch ($type){
        case 'baiviet':
            
            $count_dislike=$db->exec("
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
            if($count_dislike){
                $query= "UPDATE thich
                    SET like_dislike=0
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
                           
            break;
    }
}
header("location: index.php?page=detail&ma_bai_viet=$mabv");
?>
