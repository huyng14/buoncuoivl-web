<?php
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $maUser= $_REQUEST['maTK'];
        $passOld= md5($_POST['textOld']);
        $passNew= $_POST['textNew'];
        $passRe= $_POST['textReNew'];

        $error= array();
        $row= $db->query("
                SELECT password FROM user
                WHERE ma_user= $maUser
            ");
        $r= $row->fetch();

        if($passOld == $r[0])
        {
            if($passNew== $passRe)
            {
                if(preg_match('/^.{6,}$/', $_POST['textNew']))
                {
                    $row1=$db->exec("
                        UPDATE user
                        SET password= md5('$passNew')
                        WHERE ma_user= $maUser;
                    ");
                    if($row1>0)
                    {
                        echo 'Cập nhật thành công';
                    }
                }
                else {
                    $error[] = 'error_pass';
                }
            }
            else {
                echo 'Mật khẩu mới không khớp';
            }
        }
        else {
            echo 'Mật khẩu cũ không khớp';
        }

        if(empty($_POST['textNew']) || !preg_match('/^.{6,}$/', $_POST['textNew']))
        {
            $error[] = 'error_pass';
        }   
    }
?>
<h1>Thay đổi password</h1>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">Thay đổi password</div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                                    
                        <div class="form-group">
                                <label class="col-sm-2 control-label">Password hiện tại: </label>
                                <div class="col-sm-6">
                                    <input type="password" name="textOld" class="form-control"/>
                                </div>
                        </div>
                        
                        <div class="form-group">
                                <label class="col-sm-2 control-label">Password mới: </label>
                                <div class="col-sm-6">
                                    <input type="password" name="textNew" class="form-control"/>
                                    <span> 
                                        <?php
                                            if (!empty ($error) && in_array('error_pass', $error)) {
                                                echo 'Password lớn hơn 6 ký tự ';
                                            }
                                        ?>
                                    </span>
                                </div>
                        </div>
                        
                        <div class="form-group">
                                <label class="col-sm-2 control-label">Nhập lại Password: </label>
                                <div class="col-sm-6">
                                    <input type="password" name="textReNew" class="form-control"/>
                                </div>
                        </div>
                        
                       
                        <div class="hr-dashed"></div>
                        <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-2">
                                        <button class="btn btn-default" type="reset">Hủy</button>
                                        <button class="btn btn-primary" type="submit">Cập nhật</button>
                                </div>
                        </div>
            </form>

        </div>
    </div>
</div>
</div> 