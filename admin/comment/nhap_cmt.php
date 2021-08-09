<html>
    <head>
        <meta charset="UTF-8">
        <title>nhap_cmt</title>
    </head>
    <body>
        <?php
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
			
		 $db = new PDO("mysql:host=localhost; dbname=buoncuoi","root","");
			
			
			
            $noi_dung=$_POST['txtnoidung'];
            $trt = 0;
                if(isset($_POST['cbTT']))
                    {
                        $trt = 1;
                    }
            
            $mabv = $_POST['slBaiviet'];
            $mauser = $_POST['slUser'];
            
     
                    
                        $query="insert into comment(ma_bai_viet,ma_user,noi_dung,trang_thai) values ('$mabv','$mauser','$noi_dung',$trt)";
					
                            $count=$db->exec($query) or die ($db->errorInfo()[2]);
            
            
                        if($count>0)
                                    {
                                        echo 'Them moi thanh cong!';
                                    }                        
					
        }
        
        
    
              
                
        
        ?>
        <form action="" method="post" >
            <table width="600px">
                <tr>
                    <td>Noi dung:</td>
                    <td><input type="text" name="txtnoidung"/>
                    </td>     
                    
                </tr>
                   <tr>
                    <td>Trang thai:</td>
                    <td><input type="checkbox" name="cbTT"/>hien thi
                    </td>     
                    
                </tr>
               
                <tr>
                    <td>Chọn user</td>
                    <td>
                        <select name="slUser">
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
                    <td>dang ky </td>
                    <td> <input type="submit" value="dang ky"/> </td>
                </tr>
            </table>
        </form>
    </body>
</html>


