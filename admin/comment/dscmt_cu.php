<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Danh sach comment </title>
        <script>
            function check(ma_comment )
            {
                if(confirm('Ban co muon xoa danh muc nay khong?')==true)
                    window.location = "index.php?page=xoa_cmt&ma_comment="+ma_comment;
            }
        </script>
        
    </head>
    <body>
        <h1>Danh sach comment </h1>
        <?php
   
        $trt = 0;
                if(isset($_POST['cbTT']))
                    {
                        $trt = 1;
                    }
        $db = new PDO("mysql:host=localhost; dbname=buoncuoi","root","");
            //2. Truy van SQL
        $query = "select ma_comment,noi_dung, ma_bai_viet, ma_user, trang_thai from comment";
        
            //3. Thuc thi: cau lenh select:   $db->query(...);
        $rows = $db->query($query) or die ($db->errorInfo()[2]);
        
        if($rows!=null)
        {
            echo '<table border="1" width="600px">';
            echo '<tr>'
             . '<th>Mã comment</th>'
            . '<th>Nội dung</th>'
             . '<th>Mã bài viết</th>'
             . '<th>Mã user</th>'
             . '<th>Trạng thái</th>'
             . '<th>Công cụ</th>'
            . '</tr>';
            foreach ($rows as $r) 
            {
              $trt='<img src="del.gif"/>';
                if($r[4]==1)
                    $trt='<img src="tick.png"/>';
                echo '<tr>';
                    echo "<td>$r[0]</td>";
                    echo "<td>$r[1]</td>";
                    echo "<td>$r[2]</td>";
                    echo "<td>$r[3]</td>";
                    echo "<td>$trt</td>";
                    echo "<td>[<a href='#' onClick='check($r[0])'>Xoa</a>]"
                            . "[<a href='index.php?page=sua_cmt&ma_comment=$r[0]'>Sua</a>]</td>";
               
                echo '</tr>';
            }
            echo '</table>';
        }
        ?>
    </body>
</html>