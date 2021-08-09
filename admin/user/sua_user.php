<html>
    <head>
        <meta charset="UTF-8">
        <title>Nhập bảng user</title>
        <style> 
            span{
                color: red;
                background: yellow;
                font-size: 12 px;
            }
            .clear-float{
                /*float: left;*/
                clear: both;
            }
        </style>
        
    </head>
    <body>
        <?php
   
            if(isset($_REQUEST['maTK']))
            {
                $maUser= $_REQUEST['maTK'];

                
                $sl_qu= "SELECT * FROM user WHERE ma_user=$maUser";
                
                $rows= $db->query($sl_qu);
                
                if($rows != NULL){
                    $r=$rows->fetch();
                }
                
            if($r[1]!='adminadmin' || $r[3]!=1)   
            {
                
                if($_SERVER['REQUEST_METHOD']== 'POST')
                {                

                    $loaiUser= 0;


                    $error= array();

                    $trangThai=0;
                    if(isset($_POST['chbTT']))
                    {
                        $trangThai=1;
                    }

                    if(isset($_POST['chbLoai']))
                    {
                        $loaiUser=1;
                    }

                    if(empty($error))
                    {
                        if($_SESSION['tenUser']=='adminadmin')
                        {
                            $query="UPDATE user
                                SET loai_user= '$loaiUser', trang_thai= $trangThai
                                WHERE ma_user=$maUser";
                        }
                        else {
                            $query="UPDATE user
                                SET trang_thai= $trangThai
                                WHERE ma_user=$maUser";
                        }


                        $count= $db ->exec($query);
    //                    or die($db->errorInfo()[2]);

                        if($count> 0){
                            echo 'Sửa thành công';
                            //Xoa anh:
                            header("location: index.php?page=ds_user");
                        }

                    }
                }
            
        ?>
       
        <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default"> 
                <div class="panel-heading" class="clear-float">Sửa user</div>
                <div class="panel-body">
                <form action="" method="POST" enctype="multipart/form-data"> 
                   
                    <label class="col-sm-3 control-label" class="clear-float">Trạng thái: </label>
                        <div class="col-sm-9">
                            <div class="checkbox checkbox-success">
                                <input id="checkbox3" type="checkbox" name="chbTT" <?php if($r[7]==1) echo 'checked'; ?>>
                                <label for="checkbox3">
                                    Hiện
                                </label>
                            </div>
                        </div>
                        <br class="clear-float">
                        
                        <?php if($_SESSION['tenUser']=='adminadmin')
                        {
                        ?>
                        <label class="col-sm-3 control-label">Loại tài khoản: 
                                
                            </label>
                            <div class="col-sm-9">
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox3" type="checkbox" name="chbLoai" <?php if($r[3]==1) echo 'checked'; ?>>
                                    <label for="checkbox3">
                                        Admin
                                    </label>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="hr-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2">
                                &nbsp;
                                <button class="btn btn-primary" type="submit">Thay đổi</button>
                            </div>
                        </div>

                </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php 
        }
        else {
            ?>
 <script>
    alert('Không thể thay đổi tài khoản này!!');
    window.location.href = "index.php?page=ds_user";
</script>
<?php
        }
    }
?>
