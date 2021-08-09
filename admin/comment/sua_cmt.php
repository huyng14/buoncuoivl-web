<?php
    
      $db = new PDO("mysql:host=localhost; dbname=buoncuoi","root","");    
    if(isset($_REQUEST['ma_comment']))
    {
        $macmt = $_REQUEST['ma_comment'];
        
        
        
        $q = "select * from comment where ma_comment=$macmt";
        
        $rows = $db->query($q);
        if($rows!=null)
            $r=$rows->fetch ();
        
        
        
        if($_SERVER['REQUEST_METHOD']=='POST') //Nhan nut submit
        {
            $noi_dung=$_POST['txtnoidung'];
            $trt = 0;
                if(isset($_POST['cbTT']))
                    {
                        $trt = 1;
                    }
            
            $mabv = $_POST['slBaiviet'];
            $mauser = $_POST['slUser'];
            
           
            
            //2. Truy van sql
            $query="update comment
                    set ma_bai_viet = '$mabv', ma_user = '$mauser', trang_thai = '$trt', noi_dung = '$noi_dung'
                    where ma_comment = '$macmt'";
                            
            //3. Thuc thi: insert, update, delete => $db->exec(...);
            $count=$db->exec($query)or die ($db->errorInfo()[2]);
            
            //4. Kiem tra Kq
            if($count>0)
            {
                header('location:index.php?page=dscmt');
            }
        }
        
        
    }
    
    
    
?>
<h1>Thong tin comment</h1>
<form action="" method="post">
        <table width="600px">
                <tr>
                    <td>Noi dung:</td>
                    <td><input type="text" name="txtnoidung"  value="<?php if(isset($r)) echo $r[1]; ?>"/>
                    </td>     
                    
                </tr>
                   <tr>
                    <td>Trang thai:</td>
                    <td><input type="checkbox" name="cbTT" <?php if(isset($r) && $r[4]==1) echo'checked'; ?>"/>hien thi
                    </td>     
                    
                </tr>
               
                <tr>
                    <td>Chọn user</td>
                    <td>
                        <select name="slUser"   value="<?php if(isset($r)) echo $r[1]; ?>" >
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
                    </td>
                </tr>
                <tr>
                    <td>Chọn bai viet</td>
                    <td>
                        <select name="slBaiviet">
                            <?php
                                //1. Connect
                                $db = new PDO("mysql:host=localhost; dbname=buoncuoi","root","");    
                                //2. Truy van SQL
                                $query_bv = "SELECT ma_bai_viet, tieu_de FROM bai_viet";

                                //3. Thuc thi: cau lenh select:   $db->query(...);
                                $rows = $db->query($query_bv);
                                
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
                    <td></td>
                    <td>
                        <input type="submit" name="btnSubmit" value="Cap nhat"/>
                    </td>
                </tr>
            </table>
        </form>