<html> 
    <head> 
        <meta charset="utf-8">
        <title>Xóa dữ liệu user </title>
    </head>
    <body> 
        <?php 
            if(isset($_REQUEST['maTK'])){
                $maUser= $_REQUEST['maTK'];
                
//                2.Truy van SQL
                $query2="SELECT avatar FROM user";
                
                //Xoa file anh
                $rows= $db->query($query2) or die($db->errorInfo()[2]);
                if($rows != null){
                    $r= $rows->fetch();
                }
               
                
                //Xoa du lieu
                $query= "DELETE FROM user WHERE ma_user= $maUser";
                
//                3.Thuc thi
                $count= $db->exec($query) or die($db->errorInfo()[2]);
                
                
                if($count>0){
                    header("location: index.php?page=ds_user");
                    $linkAnh= "../images/avatar/$r[0]";
                    unlink($linkAnh);
                    echo 'Xoa thanh cong';
                }
            }
        ?>
    </body>
</html>