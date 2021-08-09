<?php
    if(isset($_REQUEST['ma_danh_muc']) && isset($_REQUEST['so_bai_viet']))
    {
        $madm = $_REQUEST['ma_danh_muc'];
        $sobv = $_REQUEST['so_bai_viet'];
             //1. Connect db
        
        
            
            //2. SQL
            $query = "delete from danh_muc where ma_danh_muc=$madm";
            
    //        $query = "delete from danh_muc where ma_danh_muc=$madm";
    //        $query.= "delete from bai_viet where ma_danh_muc=$madm";
    //        $query.="set foreign_key_checks=0";
                //3. Thuc thi
            if($sobv>0){
                $query3 ="SET FOREIGN_KEY_CHECKS=0";
                $query2 = "delete from bai_viet where ma_danh_muc=$madm";
            
            $count3=$db->exec($query3);
            $count=$db->exec($query)or die($db->errorInfo()[2]);
            $count2=$db->exec($query2) or die($db->errorInfo()[2]);
            $query3 ="SET FOREIGN_KEY_CHECKS=1";
            $db->exec($query3);
            if($count>0)
            {

                header('location: index.php?page=dsdm');
            }
        
        }else{
            $count=$db->exec($query)or die($db->errorInfo()[2]);
            if($count>0)
            {
                header('location: index.php?page=dsdm');
            }
        }
    }
?>


