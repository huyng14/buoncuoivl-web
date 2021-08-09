
<html>
    <head>
        <meta charset="UTF-8">
        <title>Danh sach comment </title>
        <script>
            function check(ma_comment )
            {
                if(confirm('Bạn có muốn xóa bình luận này không?')==true)
                    window.location = "index.php?page=xoa_cmt&ma_comment="+ma_comment;
            }
        </script>
        
    </head>
    <body>
        <h1>Danh sách bình luận </h1>
        <?php
   if(isset($_REQUEST['ma_bai_viet'])){
    $mabv = $_REQUEST['ma_bai_viet'];
        
        
        
        ?>
<!--        if($rows!=null)
        {            foreach ($rows as $r) {
//            $tt='<img src="del.gif"/>';
//                if($r[2]==1)
//                    $tt='<img src="tick.png"/>';
                
            $count = 1;
            echo '<table border="1" width="600px">';
            echo '<tr>'
            . '<th>Thứ tự</th>'
            . '<th>Người đăng</th>'            
            . '<th>Nội dung</th>'
//            . '<th>Trạng thái</th>'
            . '<th>Công cụ</th>'
            . '</tr>';
            
            echo "<td>$count</td>";
                    $query_user = "SELECT ma_user, biet_danh FROM user";

                    //3. Thuc thi: cau lenh select:   $db->query(...);
                    $rows2 = $db->query($query_user);

                    if($rows2!=null)
                    {
                        foreach ($rows2 as $r1) 
                        {
                            if($r1[0] == $r[1]) echo "<td>$r1[1]<br/>";
                                      
                        }
                    }
                    
                    echo "<td>$r[0]</td>";
//                    echo "<td>$tt</td>";
                    
                    echo "<td>[<a href='#' onClick='check($r[0])'>Xóa</a>]</td>";
                           
               
                echo '</tr>';
                
            } 
            echo '</table>';
            $count ++;
        } 
        -->
        
        
        <div class="panel panel-default">
<div class="panel-heading">Danh sách bình luận</div>
<div class="panel-body">
        <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
            <th width="60">Thứ tự</th>
                    <th>Người đăng</th>
                    <th>Nội dung</th>                 
                    <th>Công cụ</th>                   
            </tr>
                </thead>
                <tfoot>
                    <tr>
            <th>Thứ tự</th>
                    <th>Người đăng</th>
                    <th>Nội dung</th>                 
                    <th>Công cụ</th>           
                    </tr>
                </tfoot>
                

<?php
    //2. Truy van SQL
        $query = "select noi_dung, ma_user, ma_comment from comment where ma_bai_viet = $mabv";
        
            //3. Thuc thi: cau lenh select:   $db->query(...);
        $rows = $db->query($query);
        $count = 1;
        if($rows!=NULL){
        foreach ($rows as $r) {
            
            echo "<tr>";
            echo "<td>$count</td>";
             $query_user = "SELECT ma_user, biet_danh FROM user";

                    //3. Thuc thi: cau lenh select:   $db->query(...);
                    $rows2 = $db->query($query_user);

                    if($rows2!=null)
                    {
                        foreach ($rows2 as $r1) 
                        {
                            if($r1[0] == $r[1]) echo "<td>$r1[1]</td>";
                                      
                        }
                    }
            echo "<td>$r[0]</td>";
            echo "<td>[<a href='index.php?page=xoa_cmt&ma_comment=$r[2]&ma_bai_viet=$mabv' onClick='check($r[0])'>Xóa</a>]</td>";
            echo "</tr>";
            $count=$count+1;
        } 
        } else {
            echo "<h2>Bài viết không có bình luận nào!</h2>";
        }
?>
                
        </body>
        </html>        
<?php } ?>