<?php

    if(isset($_REQUEST['ma_bai_viet']))
    {
        $mabv = $_REQUEST['ma_bai_viet'];
        
             //1. Connect db
        //$db = new PDO("mysql:host=localhost;dbname=buoncuoi","root","");
        
            //2. SQL
        $query1 = "set foreign_key_checks=0";
        $query = "delete from bai_viet where ma_bai_viet=$mabv";
        $db->query($query1);
        $query2 = "delete * from thich where ma_bai_viet=$mabv";
        $db->query($query2);
        $query3 = "delete * from comment where ma_bai_viet=$mabv";
        $db->query($query3);
            //3. Thuc thi
        $count=$db->exec($query);
        if($count>0)
        {
            $query2="delete FROM bai_viet WHERE ma_bai_viet = $mabv";
                
                //Xoa file anh
                $rows= $db->query($query2) or die($db->errorInfo()[2]);
                if($rows != null){
                    $r= $rows->fetch();
                }
            $linkAnh= "../../images/anh/$r[0]";
            unlink($linkAnh);
            $query3= "set foreign_key_checks=1";
            $db->query($query3);
            header("location:setting.php?page=post");
        }
        
    }
?>
