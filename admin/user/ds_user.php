<html> 
    <head> 
        <meta charset="utf-8">
        <title>Danh sách người dùng</title>
        <script>
            function check(maUser, so_bai_viet,loaiUser){
                if(so_bai_viet>0){
                    alert('User này có nhiều bài viết. Không thể xóa user!!')
                }
                else if(loaiUser==1){
                        alert('User này là admin. Không thể xóa user!!');
                }
                    else
                    {
                        if(confirm("Bạn có chắc chắc xóa không?") == true)
                            window.location= "index.php?page=xoa_user&maTK="+ maUser;

                    }
                
            }
        </script>
    </head>
    <body> 
        
    <div class="panel panel-default">
<div class="panel-heading">Danh sách user</div>
<div class="panel-body">
        <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                        <tr>
                                <th>Mã user</th>
                                <th>Tên đăng nhập</th>
                                <!--<th>password</th>-->
                                <th>Loại user</th>
                                <th>Email</th>
                                <th>Ngày sinh</th>
                                <th>Avatar</th>
                                <th>Trạng thái</th>
                                <th width="100px">Công cụ</th>
                        </tr>
                </thead>
                <tfoot>
                        <tr>
                                <th>Mã user</th>
                                <th>Tên đăng nhập</th>
                                <!--<th>password</th>-->
                                <th>Loại user</th>
                                <th>Email</th>
                                <th>Ngày sinh</th>
                                <th>Avatar</th>
                                <th>Trạng thái</th>
                                <th width="100px">Công cụ</th>
                        </tr>
                </tfoot>
                <tbody>
                    <?php 
                        $query= "SELECT user.ma_user, ten_user, loai_user, email, ngay_sinh, avatar, user.trang_thai, count(ma_bai_viet) FROM user
                                LEFT JOIN bai_viet
                                ON user.ma_user= bai_viet.ma_user
                                GROUP BY user.ma_user, ten_user, loai_user, email, ngay_sinh, avatar, user.trang_thai";

                        $rows= $db->query($query);
                        foreach ($rows as $value) {
                            echo '<tr>';
                            echo "<td>$value[0]</td>";
                            echo "<td>$value[1]</td>";
//                            echo "<td>$value[2]</td>";

                            echo '<td>';
                            if($value[2]==1){
                                echo 'Admin';
                            }
                            else {
                                echo 'Người dùng';
                            }
                            echo '</td>';

                            echo "<td>$value[3]</td>";
                            echo "<td>$value[4]</td>";
                            echo "<td><img src='../images/avatar/$value[5]' width='200px'/></td>";

                            echo '<td>';
                            if($value[6]==1){
                                echo 'Đã kích hoạt';
                            }
                            else {
                                echo 'Chưa kích hoạt';
                            }
                            echo '</td>';

                            echo "<td>[<a href='#' onclick='check($value[0], $value[7], $value[2])' > Xóa </a>]";
                            echo "[<a href='index.php?page=sua_user&maTK=$value[0]'> Sửa </a>]</td>";
                            echo '</tr>';
                        }

                    ?>
                               
                        
                </tbody>
        </table>
</div> 
</div>
    </body>
</html>