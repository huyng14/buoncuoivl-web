<?php
    if(isset($_REQUEST['ma_comment']))
    {
        $macmt = $_REQUEST['ma_comment'];
        $mabv = $_REQUEST['ma_bai_viet'];
        
             //1. Connect db
        
        
            //2. SQL
        $query = "delete from comment where ma_comment=$macmt"  ;
        
            //3. Thuc thi
        $count=$db->exec($query);
        if($count>0)
        {
            header('location:index.php?page=dscmt&ma_bai_viet=$mabv');
        }
        
    }
?>