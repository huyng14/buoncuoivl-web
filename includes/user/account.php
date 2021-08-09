<html>
    <head>
        <meta charset="UTF-8">
        <title>Nhập bảng user</title>
        
    </head>
    <body>
        <?php
            if(isset($_COOKIE['ma_user']))
            {
                $maUser= $_COOKIE['ma_user'];
//                1.Connect du lieu
//                $db= new PDO('mysql:host=localhost;dbname=db_buoncuoivl',"root","");
                
                $sl_qu= "SELECT * FROM user WHERE ma_user=$maUser";
                
                $rows= $db->query($sl_qu);
                
                if($rows != NULL){
                    $r=$rows->fetch();
                }
                
                
                
                if($_SERVER['REQUEST_METHOD']== 'POST')
                {                
//                $ten= $_POST['txtTen'];

                $email= $_POST['txtEmail'];
                $ngaySinh= $_POST['daNgaySinh'];
               
                $file = $_FILES['fAvatar'];
                $nickName= $_POST['txtBietDanh'];
                
//                date_default_timezone_set('Asia/Ho_Chi_Minh');
//                $ngayTao= date('Y/m/d H:i:s');
                
                $error= array();

                if(empty($_POST['txtEmail']) || !filter_var($_POST['txtEmail'],FILTER_VALIDATE_EMAIL))
                {
                    $error[]='error_email';
                }
                if($file['name']!='')
                {
                    $kich_thuoc= $file['size']/1024;
                    

                    if(($file['size']/1024) >=1024)
                    {
                        $error[]='file_size';
                    }
                    else if($file['type']!='image/jpeg' && $file['type']!='image/png' && $file['type']!='image/gif')
                    {
                        $error[]='file_sai';
                    }
                }
                if(isset($_POST['chbTT']))
                {
                    $trangThai=1;
                }
                
                if(strlen($nickName)>80){
                    $error[]='error_nick';
                }
                

                
                
                if(empty($error))
                {
                    $nameAnh= $r[1].'_'.$file['name'];
                    $linkAnh= "../../images/avatar/$nameAnh";
//                    echo '<br>'.$nameAnh;
                    move_uploaded_file($file['tmp_name'], $linkAnh);    
                    
                    
//                    2.thuc thi
                    
                    if($file['name']!='')
                    {
                        $query="UPDATE user
                        SET email= '$email', ngay_sinh= '$ngaySinh', avatar= '$nameAnh', biet_danh= '$nickName'
                        WHERE ma_user=$maUser";
                    }
                    else {
                        $query="UPDATE user
                        SET email= '$email', ngay_sinh= '$ngaySinh', biet_danh= '$nickName'
                        WHERE ma_user=$maUser";
                    }
                    
                    $count= $db ->exec($query);
//                    or die($db->errorInfo()[2]);
                    
                    if(!empty($db->errorInfo()[2])){
                        //Kiem tra Trung Ten_user                        
//                        $queryTen= "SELECT ma_user, count(ma_user) FROM user
//                                    WHERE ten_user= '$ten'";
//                        $row1= $db->query($queryTen);
//                        $r1= $row1->fetch();
//                        if($r1[1]>0){
//                            $error[]='error_trungUser';
//                        }
                        
                        //Kiem tra Trung Email
                        $queryEmail= "SELECT ma_user, count(ma_user) FROM user
                                    WHERE email= '$email'";
                        $row2= $db->query($queryEmail);
                        $r2= $row2->fetch();
                        if($r2[1]>0){
                            $error[]='error_trungEmail';
                        }
                    }

                    if($count> 0){
                        echo 'Sửa thành công';
                        //Xoa anh:
                        if($file['name']!=''){
                            $linkAnh= "../../images/avatar/$r[6]";
                            unlink($linkAnh);   
                        }
                    }

                }
            }
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table>
                
                <tr> 
                    <td>Email: </td>
                    <td><input type="email" name="txtEmail" value="<?php  if(isset($r[4])) echo ''.$r[4]; ?>"> 
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
                    </td>
                </tr>
                
                <tr> 
                    <td>Tên hiển thị: </td>
                    <td><input type="text" name="txtBietDanh" value="<?php  if(isset($r[8])) echo ''.$r[8]; ?>">
                        <span> 
                            <?php
                                if (!empty ($error) && in_array('error_nick', $error)) {
                                    echo 'Tên hiển thị nhỏ hơn 80 ký tự';
                                }
                            ?>
                        </span></td>
                </tr>
                
                <tr> 
                    <td>Ngày sinh: </td>
                    <td><input name="daNgaySinh" type="date" value="<?php if(isset($r[5])) echo $r[5]; ?>"</td>
                </tr>
                
                <tr> 
                    <td>Avatar: </td>
                    <td>
                        <img src="../../images/avatar/<?php echo $r[6];?>" width="300px"/>
                        <input type="file" name="fAvatar">  
                    
                        <span> 
                            <?php if(!empty($error) && in_array('file_size', $error))
                                        echo 'Ảnh quá dung lượng 1MB';
                                else if(!empty($error) && in_array('file_sai', $error))
                                        echo 'Chọn file ảnh';?>
                        </span>
                    </td>
                               
                </tr>
                
                <tr> 
                    <td>&nbsp;</td>
                    <td><input type="submit" value="Cập nhật">  </td>
                </tr>
            </table>
        </form>
    </body>
</html>
