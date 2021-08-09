<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title></title>
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
            
            
            
            $trt = 0;   //An
            if(isset($_POST['cbTT']))
            {
                $trt=1; //Hien
            }

            if(empty($_POST['txtTenfile']))
            {
                $error[] = 'loi_tenfile';
            }
           
            $video = $_POST['fVideo'];
            $vitri= strpos($video,"v=");
            $video= 'https://www.youtube.com/embed/'.substr($video, $vitri+2);
            if(empty($_POST['fVideo']))
            {
                $error[] = 'video_rong';
            }
            else if(!filter_var($_POST['fVideo'],FILTER_VALIDATE_URL))
            {
                $error[]='error_url';
            }
            if(empty($error)){
                //2. Truy van sql
                $query = "INSERT INTO bai_viet(loai_file, tieu_de, trang_thai, link, ma_danh_muc, ngay_tao, ma_user) values
                        (1, '$ten_file', '$trt', '$video','$danh_muc', '$ngay_tao', '$ma_user')";

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
        
<!--        <form action="" method="post" enctype="multipart/form-data">
            <table>
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
                    <td>Up link video</td>
                    <td>
                        <input type="text" name="fVideo"/>
                    </td>
                    <span>
                            <?php
                            if(!empty($error) && in_array('video_rong', $error))
                            {
                                echo 'Chọn link video!';
                            }
                            else if (!empty($error) && in_array('error_url', $error))
                            {
                                echo 'Đường link không hợp lệ!';
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
        </form>-->
        
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Đăng video</div>
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


<div class="form-group">
                                <label class="col-sm-2 control-label">Link video</label>
                                <div class="col-sm-10">
                                        <input type="text" name="fVideo" class="form-control">
                                        <span>
                                            <?php
                                            if(!empty($error) && in_array('video_rong', $error))
                            {
                                echo 'Chọn link video!';
                            }
                            else if (!empty($error) && in_array('error_url', $error))
                            {
                                echo 'Đường link không hợp lệ!';
                            }
                                            ?>
                                        </span>
                                </div>
                        </div>
                        
            

            

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

                                <input id="checkbox3" type="checkbox" name="chbTT">
                                <label for="checkbox3">
                                    Hiện
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

