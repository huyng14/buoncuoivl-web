<html>
    
    <body>
        <?php
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
                $maUser= $_COOKIE['ma_user'];
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
        <form action="" method="POST">
            <table>
                <tr> 
                    <td>Password cũ: </td>
                    <td><input type="password" name="textOld"></td>
                </tr>
                
                <tr> 
                    <td>Password mới: </td>
                    <td><input type="password" name="textNew">
                    <span> 
                        <?php
                            if (!empty ($error) && in_array('error_pass', $error)) {
                                echo 'Password lớn hơn 6 ký tự ';
                            }
                        ?>
                    </span>
                    </td>
                </tr>
                
                <tr> 
                    <td>Nhập lại Password </td>
                    <td><input type="password" name="textReNew"></td>
                </tr>
                
                <tr> 
                    <td>&nbsp;</td>
                    <td><input type="submit" value="Cập nhật">  </td>
                </tr>
            </table>
        </form>
    </body>
</html>
