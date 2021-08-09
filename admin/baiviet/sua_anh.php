<?php
    if(isset($_REQUEST['ma_bai_viet']))
    {
        $mabv = $_REQUEST['ma_bai_viet'];
        
        $q = "select * from bai_viet where ma_bai_viet=$mabv";
        
        $rows = $db->query($q) or die ($db->errorInfo()[2]);
        if($rows!=null)
            $r=$rows->fetch ();
        
        $q1 = "select ma_user, ten_user from user where ma_user=$r[1]";
        $row1 = $db->query($q1) or die ($db->errorInfo()[2]);
        if ($row1 != null)
            $r1 = $row1->fetch ();
        
        $q2 = "select ma_danh_muc, ten_danh_muc from danh_muc where ma_danh_muc=$r[2]";
        $row2 = $db->query($q2) or die ($db->errorInfo()[2]);
        if ($row2 != null)
            $r2 = $row2->fetch ();
        
        
        
        if($_SERVER['REQUEST_METHOD']=='POST') //Nhan nut submit
        {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $ngay_tao= date('Y/m/d H:i:s');
            $error = array();

            $ten_file = $_POST['txtTenfile'];
            $danh_muc= $_POST['slDM'];
            $ma_user= $_POST['slUser'];
            
            
            
            $trt = 0;   //An
            if(isset($_POST['cbTT']))
            {
                $trt=1; //Hien
            }

            if(empty($_POST['txtTenfile']))
            {
                $error[] = 'loi_tenfile';
            }
            
           
            
            $ten_anh = $_FILES['fAnh']['name'];
            $kich_thuoc = $_FILES['fAnh']['size']/1024;
            $dinh_dang = $_FILES['fAnh']['type'];

//            if(empty($ten_anh))
//            {
//                $error[]='file_rong';
//            }
            if($ten_anh!='')
            {
                if($dinh_dang!='image/jpeg' && $dinh_dang!='image/png' && $dinh_dang!='image/gif' && $dinh_dang != 'image/jpg')
                {
                    $error[]='file_sai';
                }
                else if($kich_thuoc>500)                
                {
                    $error[]='file_lon';
                }
            }
            if(empty($error)){
                $nameAnh= $ma_user.'_'.$ten_anh;
                $linkAnh= "../images/anh/$nameAnh";
                move_uploaded_file($_FILES['fAnh']['tmp_name'],$linkAnh);  

                //2. Truy van sql
                if($ten_anh!='')
                {
                $query = "update bai_viet
                         set trang_thai='$trt', tieu_de='$ten_file', link='$nameAnh', ma_danh_muc='$danh_muc', ma_user='$ma_user'
                         where ma_bai_viet=$mabv";
                }
                else
                {
                $query = "update bai_viet
                         set trang_thai='$trt', tieu_de='$ten_file', ma_danh_muc='$danh_muc', ma_user='$ma_user' 
                         where ma_bai_viet=$mabv";
                }
                //3. Thuc thi
                $count=$db->exec($query) or die ($db->errorInfo()[2]);

                //4. Kiem tra Kq
                if($count>0)
                {
                    header('location:index.php?page=dsbv');
                }
                else {
                    echo "<br>Lỗi trong mảng error:";
            foreach ($error AS $value) {
                echo '<br>'.$value;
           }   
            }
 
 }

        }
    }    
        
    
    
    
    
?>
<h1>Sửa ảnh</h1>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Sửa ảnh</div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                                    
                        <div class="form-group">
                                <label class="col-sm-2 control-label">Tiêu đề</label>
                                <div class="col-sm-10">
                                        <input type="text" name="txtTenfile" class="form-control" value="<?php if(isset($r[3])) echo $r[3]; ?>"/>
                                        <span>
                                            <?php
                                            if(!empty($error) && in_array('loi_tenfile', $error))
                                            {
                                                echo 'Yêu cầu nhập tiêu đề!';
                                            }
                                            ?>
                                        </span>
                                </div>
                        </div>



                        <div class="hr-dashed"></div>
                    <div class="form-group">
                            <label class="col-sm-2 control-label">Ảnh</label>    
                            <div class="col-sm-10">
                                <?php
                                if($r[4] == 0)
                            {
                                $linkAnh="../images/anh/".$r[6];
                                echo "<img src='$linkAnh' width='320px' height='240px'/>";
                            }
                                ?>
                            
                                <input id="input-44" type="file" name="fAnh"/>                                                     
                                    <?php
                                    if(!empty($error) && in_array('file_rong', $error))
                                    {
                                        echo 'Chọn ảnh!';
                                    }
                                     else if (!empty($error) && in_array('file_sai', $error))
                                    {
                                        echo 'Chọn đúng loại file ảnh!';
                                    }
                                    else if (!empty($error) && in_array('file_lon', $error))
                                    {
                                        echo 'Kích thước phải <5MB';
                                    }                          
                                    ?>
                            </div>
                        </div> 
                    <!--<div id="errorBlock43" class="help-block"></div>-->

                    
            

                        <div class="hr-dashed"></div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label">Chọn danh mục</label>
                                <div class="col-sm-10">
                                        <select name="slDM" class="form-control">
                                            <?php echo"<option value='$r2[0]'>$r2[1]</option>"; ?>
                                            <?php
                                                //1. Connect
                                                $db = new PDO("mysql:host=localhost; dbname=buoncuoi","root","");    
                                                //2. Truy van SQL
                                                $query_dm = "SELECT ma_danh_muc, ten_danh_muc FROM danh_muc";

                                                //3. Thuc thi: cau lenh select:   $db->query(...);
                                                $rows = $db->query($query_dm);

                                                if($rows!=null)
                                                {
                                                    foreach ($rows as $r3) 
                                                    {
                                                        echo "<option value='$r3[0]'>$r3[1]</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                </div>
                        </div>    

                        <div class="hr-dashed"></div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label">Chọn user</label>
                                <div class="col-sm-10">
                                        <select name="slUser" class="form-control">
                                            <?php echo"<option value='$r1[0]'>$r1[1]</option>"; ?>
                                            <?php
                                                //1. Connect
                                                $db = new PDO("mysql:host=localhost; dbname=buoncuoi","root","");    
                                                //2. Truy van SQL
                                                $query_user = "SELECT ma_user, ten_user FROM user";

                                                //3. Thuc thi: cau lenh select:   $db->query(...);
                                                $rows = $db->query($query_user);

                                                if($rows!=null)
                                                {
                                                    foreach ($rows as $r4) 
                                                    {
                                                        echo "<option value='$r4[0]'>$r4[1]</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                </div>
                        </div>      

                        <label class="col-sm-2 control-label">Trạng thái: 
                            <br>
                        </label>
                        <div class="col-sm-10">
                            <div class="checkbox checkbox-success">

                                <input id="checkbox3" type="checkbox" name="cbTT" <?php if($r[5]==1) echo'checked'; ?>>
                                <label for="checkbox3">
                                    Duyệt
                                </label>
                            </div>
                        </div>


                        <div class="hr-dashed"></div>
                        <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-2">
                                        <button class="btn btn-default" type="reset">Hủy</button>
                                        <button class="btn btn-primary" type="submit">Sửa</button>
                                </div>
                        </div>
            </form>

        </div>
    </div>
</div>
</div>    
    
    
        


</body>
</html>

   