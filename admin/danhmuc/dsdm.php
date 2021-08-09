<html> 
    <head> 
        <meta charset="utf-8">
        <title>Danh sách danh mục</title>
        <script>
            function check(ma_danh_muc, so_bai_viet){
            if(so_bai_viet>0)
            {
               if(confirm('Danh mục này có chứa nhiều bài viết. Bạn có chắc muốn xóa danh mục này không?')==true)                  
                    window.location = "index.php?page=xoadm&ma_danh_muc="+ma_danh_muc+"&so_bai_viet="+so_bai_viet;
            }
            else
            {
                if(confirm('Bạn có chắc muốn xóa danh mục này không')==true)
                    window.location = "index.php?page=xoadm&ma_danh_muc="+ma_danh_muc+"&so_bai_viet="+so_bai_viet;
            }
        }
            
        </script>
    </head>
    <body> 
        <?php
          $query = "select danh_muc.ma_danh_muc, ten_danh_muc, thu_tu, danh_muc.trang_thai, count(ma_bai_viet) from danh_muc
                  left join bai_viet on danh_muc.ma_danh_muc = bai_viet.ma_danh_muc
                  
                  group by danh_muc.ma_danh_muc, ten_danh_muc, thu_tu, danh_muc.trang_thai
                  order by thu_tu asc";
//3. Thuc thi: cau lenh select:
            // $db->query(...);
          
             $rows = $db->query($query);
        
           
        ?>
        
        
        
        
        
    <div class="panel panel-default">
<div class="panel-heading">Danh sách danh mục</div>
<div class="panel-body">
        <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                        <tr>
                                <th>Mã danh mục</th>
                                <th>Tên danh mục</th>
                                <th>Thứ tự</th>
                                <th>Trạng thái</th>
                                <th>Công cụ</th>
                        </tr>
                </thead>
                <tfoot>
                       <tr>
                                <th>Mã danh mục</th>
                                <th>Tên danh mục</th>
                                <th>Thứ tự</th>
                                <th>Trạng thái</th>
                                <th>Công cụ</th>
                        </tr>
                </tfoot>
                <tbody>
                    <?php
   
        
            foreach ($rows as $r) 
            {
                $tt='<img src="del.gif"/>';
                if($r[3]==1)
                    $tt='<img src="tick.png"/>';
                echo '<tr>';
                    echo "<td>$r[0]</td>";
                    echo "<td>$r[1]</td>";
                    echo "<td>$r[2]</td>";
                    echo "<td>$tt</td>";
                    echo "<td>[<a href='#' onClick='check($r[0], $r[4])'>Xoa</a>]"
                            . "[<a href='index.php?page=suadm&ma_danh_muc=$r[0]'>Sua</a>]</td>";
               
                echo '</tr>';
            }
            echo '</table>';
        
        ?>
                        
                </tbody>
        </table>
    </body>
</html>