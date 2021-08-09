<head> 
    <!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
        
        
        <link rel="stylesheet" href="css/jquery-ui.min.css">
</head>
        <?php
            if($_SERVER['REQUEST_METHOD']== 'POST'){
//                 1.Connect du lieu
//                $db= new PDO('mysql:host=localhost;dbname=buoncuoi',"root","");
                $secret = "6Lc0ESoTAAAAAITrcfdxGG98z2bHLJkAJn2XVVNb";
            $ip = $_SERVER['REMOTE_ADDR'];
            $captcha = $_POST['g-recaptcha-response'];
            $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
            
            $rsp = json_decode($rsp);
                
                $ten= $_POST['txtTen'];
                $pass= md5($_POST['txtPass']);
                $email= $_POST['txtEmail'];

                $ngaySinh= date_create_from_format("d/m/Y", $_POST['daNgaySinh']);
                $ngaySinh= date_format($ngaySinh, 'Y-m-d');
                
                $file = $_FILES['fAvatar'];
                $nickName= $_POST['txtBietDanh'];
                
                //Xác thực ngày sinh
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                
                
                
                $error= array();
                
                if(empty($_POST['txtTen']) || !preg_match('/^[a-zA-Z0-9]{6,}$/', $_POST['txtTen']))
                {
                    $error[] = 'error_user';
                }

                if(empty($_POST['txtPass']) || !preg_match('/^.{6,}$/', $_POST['txtPass']))
                {
                    $error[] = 'error_pass';
                }

                if(empty($_POST['txtEmail']) || !filter_var($_POST['txtEmail'],FILTER_VALIDATE_EMAIL))
                {
                    $error[]='error_email';
                }
                
                if(isset($ngaySinh))
                {
                    $ago= date_create($ngaySinh);
                    $now= date_create('now');
                    $diff= date_diff($ago, $now);
                    
                    if(($t= $diff->format('%Y'))<=0)
                        $error[]='error_ngaySinh';
                }
                
                if($file['name']!=''){
                    if($file['type']!='image/jpeg' && $file['type']!='image/png' && $file['type']!='image/gif')
                    {
                        $error[]='file_sai';
                    }
                }
                
                if(strlen($nickName)>80){
                    $error[]='error_nick';
                }
                
                if(empty($error)){
                    $nameAnh= $ten.'_'.$file['name'];
                    $linkAnh= "images/avatar/$nameAnh";
//                    echo '<br>'.$nameAnh;
                    
                    
//                    2.thuc thi
                    $query= "INSERT INTO user(ten_user, password, email, ngay_sinh, avatar, biet_danh) VALUES
                                ('$ten','$pass', '$email', '$ngaySinh','$nameAnh', '$nickName')";
                    
                    $count= $db ->exec($query);
//                    or die($db->errorInfo()[2]);
                   
                    
                    
                    if(!empty($db->errorInfo()[2])){
                        //Kiem tra Trung Ten_user                        
                        $queryTen= "SELECT ma_user, count(ma_user) FROM user
                                    WHERE ten_user= '$ten'";
                        $row1= $db->query($queryTen);
                        $r1= $row1->fetch();
                        if($r1[1]>0){
                            $error[]='error_trungUser';
                        }
                        
                        //Kiem tra Trung Email
                        $queryEmail= "SELECT ma_user, count(ma_user) FROM user
                                    WHERE email= '$email'";
                        $row2= $db->query($queryEmail);
                        $r2= $row2->fetch();
                        if($r2[1]>0){
                            $error[]='error_trungEmail';
                        }
                    }
                    
//                    echo '<br>'.$query;
                    if($count> 0 && $rsp->success == true) {
                        move_uploaded_file($file['tmp_name'], $linkAnh);
                        echo '<h3>Đăng ký thành công</h3>';
                    } elseif ($rsp->success == false){
                echo "<h1>SPAM !!!</h1>";
            }
                }
            }
        ?>
   
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h2>Đăng ký</h2></div>
                <div class="panel-body">
                    <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                            <label class="col-sm-3 control-label">Tên đăng nhập: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="txtTen" value="<?php  if(isset($ten)) echo ''.$ten; ?>" >
                                <?php 

                                    if (!empty ($error) && in_array('error_user', $error)) {
                                        echo 'Tên đăng nhập không có ký tự đặc biệt và lớn hơn 6 ký tự';
                                    }
                                    if (!empty ($error) && in_array('error_trungUser', $error)) {
                                        echo 'Tên này đã tồn tại';
                                    }
                                ?>
                            </div>
                    </div>



                    <div class="hr-dashed"></div>
                    <div class="form-group">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="txtPass">  
                                <span> 
                                    <?php
                                        if (!empty ($error) && in_array('error_pass', $error)) {
                                            echo 'Password lớn hơn 6 ký tự';
                                        }
                                    ?>
                                </span>
                            </div>
                    </div>



                    <div class="hr-dashed"></div>
                    <div class="form-group">
                            <label class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-10">

                                <input type="email" class="form-control" name="txtEmail" value="<?php  if(isset($email)) echo ''.$email; ?>"> 
                                    <span>
                                        <?php
                                            if (!empty ($error) && in_array('error_email', $error)) {
                                                echo 'Nhập đúng email';
                                            }
                                            if (!empty ($error) && in_array('error_trungEmail', $error)) {
                                                echo 'Email này đã được sử dụng';
                                            }
                                        ?>
                                    </span>
                            </div>
                    </div>
                    
                    <div class="hr-dashed"></div>
                    <div class="form-group">
                            <label class="col-lg-2 control-label">Tên hiển thị</label>
                            <div class="col-lg-10">

                                <input type="text" class="form-control" name="txtBietDanh" value="<?php  if(isset($nickName)) echo ''.$nickName; ?>"> 
                                    <span>
                                        <?php
                                            if (!empty ($error) && in_array('error_nick', $error)) {
                                                echo 'Tên hiển thị nhỏ hơn 80 ký tự';
                                            }
                                        ?>
                                    </span>
                            </div>
                    </div>

                    <div class="hr-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Ngày sinh</label>
                        <div class="col-sm-4">
                            <input name="daNgaySinh" type="txt" class="form-control" id="datepicker" value="<?php if(isset($ngaySinh)) echo $ngaySinh; ?>"> 
                        </div>
                        <span> 
                            <?php 
                                if(!empty($error) && in_array('error_ngaySinh', $error)){
                                    echo 'Ngày sinh không hợp lệ';
                                } 
                            ?>
                        </span>
                    </div>


                    <div class="hr-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Avatar</label>
                        <div class="col-sm-10">
                            <input type="file" name="fAvatar" id="input-43">
                            <?php if(!empty($error) && in_array('file_sai', $error))
                                        echo 'Chọn file ảnh';
                            ?>
                        </div>
                    </div>
                    <div id="errorBlock43" class="help-block"></div>
                    
<div class="g-recaptcha" data-sitekey="6Lc0ESoTAAAAAIsJ9GKapZ_zDtbBHISTUlVELemy"></div>
                    <div class="hr-dashed"></div>
                    <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn btn-default" type="reset">Hủy</button>
                                <button class="btn btn-primary" type="submit">Đăng ký</button>
                            </div>
                    </div>

            </form>

            </div>
        </div>
    </div>
</div>



<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>-->

<script type="text/javascript" src="js/jqueryUI/jquery-1.12.4.js"></script>
<script type="text/javascript" src="js/jqueryUI/jquery-ui.js"></script>
<script type="text/javascript">
    $(function(){
        $("#datepicker").datepicker({
            dateFormat: "dd/mm/yy",
            changeMonth: true,
            changeYear: true,
            minDate: "-150Y",
//                    maxDate: "",
            yearRange: "c-100 : c+0"
        });
    });
</script>

</body>
</html>

