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
            $mauser = $_COOKIE['ma_user'];
            
            
            
            
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
            if(empty($error) && $rsp->success == true){
                //2. Truy van sql
                $query = "INSERT INTO bai_viet(loai_file, tieu_de, link, ma_danh_muc, ngay_tao, ma_user) values
                        (1, '$ten_file', '$video','$danh_muc', '$ngay_tao', $mauser)";

                //3. Thuc thi
                $count=$db->exec($query) or die($db->errorInfo()[2]);

                //4. Kiem tra Kq
                if($count>0)
                {
                    echo 'Đăng video thành công! Video của bạn đang được chờ kiểm duyệt';
                } 
            }  elseif ($rsp->success == false){
                echo "Yêu cầu bạn nhập lại captcha";
            }
        }       
?>   
<h3>Mời nhập thông tin video</h3> 
        <form action="" method="post" enctype="multipart/form-data">
            <table>              
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
                    <div class="g-recaptcha" data-sitekey="6Lc0ESoTAAAAAIsJ9GKapZ_zDtbBHISTUlVELemy"></div>
                    <td>&nbsp;</td>
                    <td>
                        <input type="submit" value="Đăng bài"/>
                    </td>
                </tr>
            </table>
        </form>
<?php
        } else {
            header('location:login.php');
        }
?>

