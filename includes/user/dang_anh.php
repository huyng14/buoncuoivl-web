 <?php
  if(isset($_COOKIE['ma_user']))      {
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $secret = "6Lc0ESoTAAAAAITrcfdxGG98z2bHLJkAJn2XVVNb";
            $ip = $_SERVER['REMOTE_ADDR'];
            $captcha = $_POST['g-recaptcha-response'];
            $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
            
            $rsp = json_decode($rsp);
            
            
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $ngay_tao= date('Y/m/d H:i:s');
            $error = array();
            $ten_file = $_POST['txtTenfile'];
            $danh_muc= $_POST['slDM'];
            $ma_user= $_COOKIE['ma_user'];
            
            
            
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
            if(empty($error) && $rsp->success == true){
                $linkAnh= "../../images/anh/".$ten_anh;
                move_uploaded_file($_FILES['fAnh']['tmp_name'],$linkAnh);

                //2. Truy van sql
                $query = "INSERT INTO bai_viet(loai_file, tieu_de, trang_thai, link, ma_danh_muc, ngay_tao, ma_user) VALUES
                        (0, '$ten_file', '$trt', '$ten_anh', '$danh_muc', '$ngay_tao', '$ma_user')";

                //3. Thuc thi
                $count=$db->exec($query) or die($db->errorInfo()[2]);

                //4. Kiem tra Kq
                if($count>0)
                {
                    echo '<h2>Đăng ảnh thành công! Ảnh của bạn đang được chờ kiểm duyệt</h2>';
                }
            } elseif ($rsp->success == false){
                echo "Yêu cầu bạn nhập lại captcha";
            }
            
        } 
            
            
            
        
        
        ?>
<html>
    <head>
        <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<meta charset=utf-8 />
<!--<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(500)
                    .height(300);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>-->
    </head>
<h3>Mời nhập thông tin ảnh</h3>        
<form action="" method="post" enctype="multipart/form-data">
            <table>
                
                
                <tr>
                    <td>Tiêu đề</td>
                    <td>
                        <input size="70" type="text" name="txtTenfile"/>
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
                        <input type="file" name="fAnh" onchange="readURL(this);"/>
                        
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
                <!--<tr><img id="blah" src="#" alt="" /></tr>-->
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
                    <div class="g-recaptcha" data-sitekey="6Lc0ESoTAAAAAIsJ9GKapZ_zDtbBHISTUlVELemy"></div>
                    <td>&nbsp;</td>
                    <td>
                        <input type="submit" value="Đăng bài"/>
                    </td>
                </tr>
            </table>
        </form>  
</html>
<?php
        } else {
            header('location:login.php');
        }
?>
