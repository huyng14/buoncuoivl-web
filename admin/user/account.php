<?php
    if(isset($_REQUEST['maTK'])){
        
        $maUser= $_REQUEST['maTK'];
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
            $linkAnh= "../images/avatar/$nameAnh";

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
//                $queryTen= "SELECT ma_user, count(ma_user) FROM user
//                            WHERE ten_user= '$ten'";
//                $row1= $db->query($queryTen);
//                $r1= $row1->fetch();
//                if($r1[1]>0){
//                    $error[]='error_trungUser';
//                }

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
                echo 'S???a th??nh c??ng';
                move_uploaded_file($file['tmp_name'], $linkAnh);    
                //Xoa anh:
                if($file['name']!=''){
                    $linkAnh= "../images/avatar/$r[6]";
                    unlink($linkAnh);   
                }
            }

        }
    }
}
?>
<h1>Th??ng tin t??i kho???n</h1>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">Th??ng tin t??i kho???n</div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                                    
                        <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-6">
                                    <input type="email" name="txtEmail" class="form-control" value="<?php  if(isset($r[4])) echo ''.$r[4]; ?>"/>
                                        <span>
                                           <?php
                                                if (!empty ($error) && in_array('error_email', $error)) {
                                                    echo 'Nh???p ????ng email';
                                                }
                                                if (!empty ($error) && in_array('error_trungEmail', $error)) {
                                                    echo 'Email n??y ???? ???????c s??? d???ng';
                                                }
                                            ?>
                                        </span>
                                </div>
                        </div>
                        
                        <div class="form-group">
                                <label class="col-sm-2 control-label">T??n hi???n th???: </label>
                                <div class="col-sm-8">
                                    <input type="text" name="txtBietDanh" class="form-control" value="<?php if(isset($r[8])) echo ''.$r[8]; ?>"/>
                                        <span>
                                            <?php
                                                if (!empty ($error) && in_array('error_nick', $error)) {
                                                    echo 'T??n hi???n th??? nh??? h??n 80 k?? t???';
                                                }
                                            ?>
                                        </span>
                                </div>
                        </div>
                        
                        <div class="form-group">
                                <label class="col-sm-2 control-label">Ng??y sinh: </label>
                                <div class="col-sm-4">
                                    <input type="date" name="daNgaySinh" class="form-control" value="<?php if(isset($r[5])) echo $r[5]; ?>"/>
                                        
                                </div>
                        </div>

                        <div class="hr-dashed"></div>
                    <div class="form-group">
                            <label class="col-sm-2 control-label">Avartar</label>    
                            <div class="col-sm-10">
                                <?php
                                    if($r[6] != NULL)
                                    {
                                        $linkAnh="../images/avatar/".$r[6];
                                        echo "<img src='$linkAnh' width='320px' height='240px'/>";
                                    }
                                    
                                ?>
                                <input id="input-43" type="file" name="fAvatar"/> 
                            </div>
                        </div> 

                               
                
                        <div class="hr-dashed"></div>
                        <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-2">
                                        <button class="btn btn-default" type="reset">H???y</button>
                                        <button class="btn btn-primary" type="submit">C???p nh???t</button>
                                </div>
                        </div>
            </form>

        </div>
    </div>
</div>
</div>    