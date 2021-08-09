<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Danh sách bài viết</title>
        <script>
            function check(ma_bai_viet)
            {
                if(confirm('Bạn có muốn xóa bài viết này không?')==true)
                    window.location = "index.php?page=xoabv&ma_bai_viet="+ma_bai_viet;
            }
        </script>
        <style>
            th {text-align: center;}
        </style>    
    </head>
    <body>
        <!--<h1>Danh sách bài viết</h1>-->
        
        
       <div class="panel panel-default">
<div class="panel-heading">Danh sách user</div>
<div class="panel-body">
        <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                
                    <tr>
            <th>Mã bài viết</th>
                    </tr>
                    <tr>
                    <th>Người đăng</th>
                    </tr>
                    <tr>
                    <th>Danh mục</th>
                    </tr>
                    <tr>                      
                    <th width="50px">Tiêu đề</th>
                    </tr>
                    <tr>
                    <th>Loại file</th>
                    </tr>
                    <tr>
                    <th>Trạng thái</th>   
                    </tr>
                    <tr>
                    <th>Bài</th>
                    </tr>
                    <tr>
                    <th>Ngày tạo</th>
                    </tr>
                    <tr>
                    <th>Công cụ</th>
                    </tr>
                    <tr>
                    <th>Đăng</th>
            </tr>
                
                
                    
                
            <?php
            $query= "SELECT * FROM bai_viet";

                $rows= $db->query($query);
                        
            foreach ($rows as $r) 
            {
                $tt='<img src="del.gif"/>';
                if($r[5]==1)
                    $tt='<img src="tick.png"/>';
                echo '<tr>';
                //echo '<th>Mã bài viết</th>';
                    echo "<td>$r[0]</td>";
                    echo '</tr>';
                    
                    echo "<tr>";
                    //echo "<th>Người đăng</th>";
                    //1. Connect
                    //$db = new PDO("mysql:host=localhost; dbname=buoncuoi","root","");    
                    //2. Truy van SQL
                    $query_user = "SELECT ma_user, ten_user, ngay_sinh, email FROM user";

                    //3. Thuc thi: cau lenh select:   $db->query(...);
                    $rows = $db->query($query_user);

                    if($rows!=null)
                    {
                        foreach ($rows as $r1) 
                        {
                            if($r1[0] == $r[1])                              
                            echo"<td>$r1[1]<br/>
                                    $r1[2]<br/>
                                    $r1[3]</td>";    
                        }
                    }
                    echo "</tr>";
                    echo "<tr>";
                    //echo "<th>Danh mục</th>";
                    //1. Connect
                    //$db = new PDO("mysql:host=localhost; dbname=buoncuoi","root","");    
                    //2. Truy van SQL
                    $query_dm = "SELECT ma_danh_muc, ten_danh_muc FROM danh_muc";

                    //3. Thuc thi: cau lenh select:   $db->query(...);
                    $rows = $db->query($query_dm);

                    if($rows!=null)
                    {
                        foreach ($rows as $r2) 
                        {
                            if($r2[0] == $r[2]) echo "<td>$r2[1]</td>";

                        }
                    }
                    //echo "<td>$r[2]</td>";
                    echo "</tr>";
                    echo "<tr>";
                    //echo "<th>Tiêu đề</th>";
                    echo "</tr>";
                    echo "<tr>";
                    //echo "<th>Loại file</th>";                  
                    if($r[4]==0)
                    {
                        echo "<td>Ảnh</td>";
                    } elseif ($r[4]==1) 
                    {
                        echo "<td>Video</td>";
                    }
                    echo "</tr>";
                    echo "<tr>";
                    //echo "<th>Trạng thái</th>";
                    echo "<td>$tt</td>";
                    echo "</tr>";
                    echo "<tr>";
                    //echo "<th>Bài</th>";
                    if($r[4] == 0)
                    {
                        $linkAnh="../images/anh/".$r[6];
                        echo "<td><img src='$linkAnh' width='320px' height='240px'/></td>";
                    }
                    else if($r[4] == 1)
                    {
                        echo "<td><iframe width='320' height='240' src='$r[6]' frameborder='0' allowfullscreen>";
                        echo "</iframe></td>";
                    }
                    echo "</tr>";
                    echo "<tr>";
                    //echo "<th>Ngày tạo</th>";
                    echo "<td>$r[7]</td>";
                    echo "</tr>";
                    echo "<tr>";
                    //echo "<th>Công cụ</th>";
                    echo "<td>[<a href='#' onClick='check($r[0])'>Xóa</a>]";
                    
                    
                    if($r[4] == 0)
                    {
                        echo "[<a href='index.php?page=sua_anh&ma_bai_viet=$r[0]'>Sửa ảnh</a>]</td>";
                    }
                    if($r[4] == 1)
                    {
                        echo "[<a href='index.php?page=sua_video&ma_bai_viet=$r[0]'>Sửa video</a>]</td>";
                    }
                    echo "</tr>";
                    echo "<tr>";
                    //echo "<th>Đăng bài</th>";
                    echo "<td>[<a href='index.php?page=uploaded&ma_bai_viet=$r[0]'>Đăng bài </a>]";
                echo '</tr>';
            }
            
        
        ?>
        
        </table>
</body>
</html>
