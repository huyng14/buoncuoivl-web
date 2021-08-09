<?php
if(isset($_REQUEST['ma_bai_viet']))
{
    $mabv = $_REQUEST['ma_bai_viet'];
    
    $query= "UPDATE bai_viet
            SET trang_thai=1
            WHERE ma_bai_viet= $mabv";
    $count= $db->exec($query) or die($db->errorInfo()[2]);
    if ($count>0){
        header("location:index.php?page=dsbv#".$mabv);
    }
}
?>
