<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Đăng ảnh</title>
    </head>
    <body>
        <?php
        $db = new PDO("mysql:host=localhost; dbname=buoncuoi","root","");
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $ngay_tao= date('Y/m/d H:i:s');
            $error = array();
            $ten_file = $_POST['txtTenfile'];
            $danh_muc= $_POST['slDM'];
            $ma_user= $_POST['slUser'];
            //$ma_user = $_SESSION['tenUser'];
            
            
            
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

            if(empty($ten_anh))
            {
                $error[]='file_rong';
            }
              else if($dinh_dang!='image/jpeg' && $dinh_dang!='image/png' && $dinh_dang!='image/gif' && $dinh_dang != 'image/jpg')
            {
                $error[]='file_sai';
            }
            else if($kich_thuoc>5120)                
            {
                $error[]='file_lon';
            }
            if(empty($error)){
                $nameAnh= $ma_user.'_'.$ten_anh;
                $linkAnh= "../images/anh/$nameAnh";
                move_uploaded_file($_FILES['fAnh']['tmp_name'],$linkAnh);

                //2. Truy van sql
                $query = "INSERT INTO bai_viet(loai_file, tieu_de, trang_thai, link, ma_danh_muc, ngay_tao, ma_user) VALUES
                        (0, '$ten_file', '$trt', '$nameAnh', '$danh_muc', '$ngay_tao', '$ma_user')";

                //3. Thuc thi
                $count=$db->exec($query) or die($db->errorInfo()[2]);

                //4. Kiem tra Kq
                if($count>0)
                {
                    echo 'Them moi thanh cong!';
                }
            }
            
            
            
            
            
        }
        
        ?>
        
<!--<form action="" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Loại file</td>
                    <td>
                        <input type="radio" name="rdoFile" value=0/>Ảnh
                        <input type="radio" name="rdoFile" value=1/>Video
                    </td>
                    <span>
                            <?php
                            if(!empty($error) && in_array('loi_loaifile', $error))
                            {
                                echo 'Yêu cầu chọn loại file!';
                            }
                            ?>
                    </span>
                </tr>
                <tr>
                    <td>Trạng thái</td>
                    <td>
                        <input type="checkbox" name="cbTT"/>Hiển thị
                    </td>
                </tr>
                <tr>
                    <td>Tiêu đề</td>
                    <td>
                        <input type="text" name="txtTenfile"/>
                    </td>
                    <span>
                            <?php
                            if(!empty($error) && in_array('loi_tenfile', $error))
                            {
                                echo 'Yêu cầu nhập tiêu đề!';
                            }
                            ?>
                    </span>
                </tr>
                <tr>
                    <td>Up ảnh</td>
                    <td>
                        <input type="file" name="fAnh"/>
                    </td>
                    <span>
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
                                echo 'Kích thước phải < 500kb!';
                            }                          
                            ?>
                    </span>
                </tr>
                <tr>
                    <td>Chọn danh mục</td>
                    <td>
                        <select name="slDM">
                            <?php
                                //1. Connect
                                $db = new PDO("mysql:host=localhost; dbname=buoncuoi","root","");    
                                //2. Truy van SQL
                                $query_dm = "SELECT ma_danh_muc, ten_danh_muc FROM danh_muc";

                                //3. Thuc thi: cau lenh select:   $db->query(...);
                                $rows = $db->query($query_dm);
                                
                                if($rows!=null)
                                {
                                    foreach ($rows as $r) 
                                    {
                                        echo "<option value='$r[0]'>$r[1]</option>";
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Chọn mã user</td>
                    <td>
                        <select name="slUser">
                            <?php
                                //1. Connect
                                $db = new PDO("mysql:host=localhost; dbname=buoncuoi","root","");    
                                //2. Truy van SQL
                                $query_dm = "SELECT ma_user, ten_user FROM user";

                                //3. Thuc thi: cau lenh select:   $db->query(...);
                                $rows = $db->query($query_dm);
                                
                                if($rows!=null)
                                {
                                    foreach ($rows as $r) 
                                    {
                                        echo "<option value='$r[0]'>$r[1]</option>";
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="submit" value="Đăng bài"/>
                    </td>
                </tr>
            </table>
        </form>        -->
                       


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Đăng ảnh</div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                                    
                        <div class="form-group">
                                <label class="col-sm-2 control-label">Tiêu đề</label>
                                <div class="col-sm-10">
                                        <input type="text" name="txtTenfile" class="form-control">
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
                            <input type="file" name="fAnh" id="input-44">
<span>
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
                                echo 'Kích thước phải < 500kb!';
                            }                          
                            ?>
                    </span>                            
                        </div>
                    </div>
                    <div id="errorBlock43" class="help-block"></div>

            

            

                        <div class="hr-dashed"></div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label">Chọn danh mục</label>
                                <div class="col-sm-10">
                                        <select name="slDM" class="form-control">
                                            <?php
                                                //1. Connect
                                                $db = new PDO("mysql:host=localhost; dbname=buoncuoi","root","");    
                                                //2. Truy van SQL
                                                $query_dm = "SELECT ma_danh_muc, ten_danh_muc FROM danh_muc";

                                                //3. Thuc thi: cau lenh select:   $db->query(...);
                                                $rows = $db->query($query_dm);

                                                if($rows!=null)
                                                {
                                                    foreach ($rows as $r) 
                                                    {
                                                        echo "<option value='$r[0]'>$r[1]</option>";
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
                                            <?php
                                                //1. Connect
                                                $db = new PDO("mysql:host=localhost; dbname=buoncuoi","root","");    
                                                //2. Truy van SQL
                                                $query_user = "SELECT ma_user, ten_user FROM user";

                                                //3. Thuc thi: cau lenh select:   $db->query(...);
                                                $rows = $db->query($query_user);

                                                if($rows!=null)
                                                {
                                                    foreach ($rows as $r) 
                                                    {
                                                        echo "<option value='$r[0]'>$r[1]</option>";
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

                                <input id="checkbox3" type="checkbox" name="cbTT">
                                <label for="checkbox3">
                                    Duyệt
                                </label>
                            </div>
                        </div>


                        <div class="hr-dashed"></div>
                        <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-2">
                                        <button class="btn btn-default" type="reset">Hủy</button>
                                        <button class="btn btn-primary" type="submit">Đăng</button>
                                </div>
                        </div>
            </form>

        </div>
    </div>
</div>
</div>
        
    </body>
</html>