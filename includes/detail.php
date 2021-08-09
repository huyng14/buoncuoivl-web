<html>
    <head>
       
        
        <script>
            $(document).ready(function(){
                $("#toggle a").click(function(){
                    var text= $(this).attr('title');
                    $("#show-emotion").val($("#show-emotion").val()+text);
                });
            });

        </script>
        <script>
            $(document).ready(function(){
            var opt = {
                    handle: '#etoggle',
                    dir: 'emotions/',
                    label_on: 'On Emotions',
                    label_off: 'Off Emotions',
                    style: 'background: #eee',
                    css: 'class2'
            }
            $('.emotion').emotions(opt);
            });
        </script>
    </head>
    <body>
<?php

if(isset($_REQUEST['ma_bai_viet']))
{
     $mabv = $_REQUEST['ma_bai_viet'];
        
        $q = "select * from bai_viet where ma_bai_viet=$mabv";
        
        $rows = $db->query($q);
        if($rows!=null)
            $r=$rows->fetch ();
        
        $baivietQuery = $db->query("
        SELECT
        bai_viet.link,
        bai_viet.loai_file,
        bai_viet.ma_bai_viet,
        bai_viet.tieu_de,
        bai_viet.ngay_tao,
        user.biet_danh,
        COUNT(thich.like_dislike) AS likes,
        GROUP_CONCAT(user.ten_user SEPARATOR '|') AS liked_by

        FROM bai_viet 

        LEFT JOIN thich
        ON bai_viet.ma_bai_viet = thich.ma_bai_viet AND thich.like_dislike=1

        LEFT JOIN user
        ON bai_viet.ma_user = user.ma_user

        where bai_viet.ma_bai_viet = $mabv 
        GROUP BY bai_viet.ma_bai_viet
        


        ");

    while($row = $baivietQuery->fetch(PDO::FETCH_OBJ)){
    $row->liked_by = $row->liked_by ? explode('|', $row->liked_by) : [];
    $baiviet[] = $row;
    }

    $baivietQuery1 =$db->query("
        SELECT
        bai_viet.ma_bai_viet,
        COUNT(thich.like_dislike) AS dislikes


        FROM bai_viet

        LEFT JOIN thich
        ON bai_viet.ma_bai_viet = thich.ma_bai_viet AND thich.like_dislike=0

        LEFT JOIN user
        ON bai_viet.ma_user = user.ma_user

        where bai_viet.ma_bai_viet = $mabv
        GROUP BY bai_viet.ma_bai_viet
        ");

    while($row1 = $baivietQuery1->fetch(PDO::FETCH_OBJ)){
    $baiviet1[] = $row1;
    }
    
    for($i=0; $i<1; $i++):
        $NumOfLikes = $baiviet[$i]->likes;
        $NumOfDislikes = $baiviet1[$i]->dislikes;
        $TotalRatings = $NumOfLikes + $NumOfDislikes; 
        if ($NumOfLikes <= 0 && $NumOfDislikes <= 0)
        {
            $LikesPercentage = 50;
            $DislikesPercentage = 50;
        }
        else if($NumOfLikes>0 || $NumOfDislikes >0) {
        $LikesCal = $baiviet[$i]->likes / $TotalRatings;
        $LikesPercentage = $LikesCal * 100;

        $DislikesCal = $baiviet1[$i]->dislikes / $TotalRatings;
        $DislikesPercentage = $DislikesCal * 100; }
            
        

?>
<html>
    <head>
        
<script>
    function myFunction() {        
        alert('Yêu cầu đăng nhập!');
        window.location.href = "login.php";     
}
</script>    
    </head>
<body>
<div id="body" class="width">

	<section id="content" class="two-column with-right-sidebar">

	    <article>
            
	    <h2><?php echo $r[3]; ?></h2>
            <?php 
            if($r[4]==0)
            {
            $linkAnh = 'images/anh/'.$r[6];
            ?>
            <img src="<?php echo $linkAnh; ?>" style="width:100%; height:100%">
            
            <?php
            } else if ($r[4]==1) {
            ?>
            <iframe width='100%' height='450px' src='<?php echo $r[6]; ?>' frameborder='0' allowfullscreen></iframe>
            
            <?php
            }
            ?>
            <div style="float:left; background-color:green; width:<?php echo $LikesPercentage; ?>%; height:30px;"></div>
            <div style="float:right; background-color:red; width:<?php echo$DislikesPercentage; ?>%; height:30px;"></div>      
            <p><?php echo $baiviet[$i]->likes; ?> người thích bài này.</p>           
            <p><?php echo $baiviet1[$i]->dislikes ; ?> người không thích bài này</p>		
            <?php if(isset($_COOKIE['ma_user'])) { ?>
            <a href="like_detail.php?type=baiviet&ma_bai_viet=<?php echo $baiviet[$i]->ma_bai_viet; ?>" class="button">Thích</a>
            <a href="dislike_detail.php?type=baiviet&ma_bai_viet=<?php echo $baiviet[$i]->ma_bai_viet; ?>" class="button button-reversed">Không thích</a>
            <?php } else { ?>
            <a href="#" class="button" onclick="myFunction()">Thích</a>
            <a href="#" class="button button-reversed" onclick="myFunction()">Không thích</a>
            <?php } ?>
            <?php 
            
               $query = "select * from user
                        join bai_viet on user.ma_user = bai_viet.ma_user
                       ";
               $rows = $db->query($query) or die($db->errorInfo()[2]);
        if($rows!=null)
            $row=$rows->fetch ();
               ?>
            <h3>Đăng bởi: <?php echo $row[8]; ?></h3>
            <h4>Ngày đăng: <?php echo $r[7]; ?></h4>
          
            </article>            
<?php
    endfor;
}   
?>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
<?php
    if(isset($_COOKIE['admin_buoncuoi']))
    {
        $user_comment= $db->query("
                SELECT 
                    biet_danh, 
                    avatar
                FROM user
                WHERE ma_user= {$_COOKIE['ma_user']}
            ") or die($db->errorInfo()[2]);
       
        $user_cmt= $user_comment->fetch();
        
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $trt = 1;
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $ngay_tao=date('Y/m/d H:i:s');

            $mauser=$_COOKIE['ma_user'];
            $mabv= $_REQUEST['ma_bai_viet'];
            $noi_dung=$_POST['txt'];

            $query1="insert into comment(ma_bai_viet,ma_user,noi_dung,trang_thai,ngay_tao) values ('$mabv','$mauser','$noi_dung',$trt,'$ngay_tao')";

            $count=$db->exec($query1);
        }
    
?>
        <div class="section box-comment">
            <div load class="fn-dynamic" data-fn="zmp3Comment" data-id="ZW7UBE7W" data-type="song"></div>
            <i class="fn_zme_info" style="display: none;" data_uid="0" data-thumb=".fn-useravatar" data-thumbsize="120"></i>
            <a name="comment" class="none"></a>
            
            <form action="" method="POST" class="frm-comment fn-comment" >
                <br class="clear-float"/>
                <div class="wrap-comment" style="float: left">
                    <textarea name="txt" id="show-emotion" class="emotion" cols="70" rows="5" placeholder="Write your comment..." ></textarea>
<!--                    <a href="http://memeful.com/" target="_blank" id="meme"><img src="images-icon-20641.png"/></a>  -->
                       <div id="toggle"> 
                           <a title=":)"><img src="emotions/1.png" alt=":)"></a>
                           <a title=":x"><img src="emotions/2.png" alt=":x"></a>
                           <a title=":P"><img src="emotions/3.png" alt=":P"></a>
                           <a title=":o"><img src="emotions/4.png" alt=":o"></a>
                           <a title=":ss"><img src="emotions/5.png" alt=":ss"></a>
                           <a title=":c"><img src="emotions/6.png" alt=":c"></a>
                           <a title=":B"><img src="emotions/7.png" alt=":B"></a>
                           <a title=":v"><img src="emotions/8.png" alt=":v"></a>
                           <a title=":("><img src="emotions/9.png" alt=":("></a>
                        </div>
                    <button name="btnSubmit" type="submit" class="button btn-dark-blue pull-right" >Bình luận</button>
                 </div>
        </form>
<!--        <ul id="commentList" class="list-comment">
                <li class="item-comment none" id="tplComment" data-type="comment" data-id="0">
                        <a target="_blank" rel="nofollow" href="" class="thumb-user fn-link">
                                <img class="fn-thumb" width="50" zmp3-thumbnail src="" alt=""/>
                        </a>
                        <div class="post-comment">
                                <a target="_blank" rel="nofollow" class="fn-link fn-dname" >mai quang tu</a>
                                <p class="fn-content"></p>
                                <span class="fn-time time-comment"></span>
                        </div>
                        <span class="btn-delete fn-delete fn-mod none" data-item="#tplComment">Xóa bình luận</span>
                </li>
        </ul>-->
	</div>
<?php
    } else {
        echo "<h1>Bạn phải đăng nhập mới bình luận được</h1>";
    }
?>
    
    <!--Hien list comment-->
<?php

        //2. Truy van SQL
    $query2 ="SELECT 
            comment.ma_comment, 
            comment.noi_dung, 
            comment.ma_bai_viet, 
            comment.ma_user, 
            user.ten_user, 
            user.avatar,
            COUNT(comment.ma_bai_viet) AS luong_cmt
            FROM comment 

            LEFT JOIN user
            ON comment.ma_user = user.ma_user

            JOIN bai_viet
            ON comment.ma_bai_viet = $mabv
            group by comment.ma_comment";
    
    

        //3. Thuc thi: cau lenh select:   $db->query(...);
    $rows1 = $db->query($query2) or die($db->errorInfo()[2]);
?>
        <h3 class="title-section">Bình luận 
            <span id="commentCounter"></span>
        </h3>
<?php 
        if($rows1!=null)
        {
            foreach ($rows1 as $r) 
            {
       
                $linkAnh= "images/avatar/".$r[5];
?>
                <div style="display: block">
                    <!--<p><small>5 days ago</small></p>-->

                    <div style="display: block; float: left">
                        <img src="<?php echo $linkAnh?>" style="margin: 0 15px 0 0; width: 50px" >
                    </div>
                    <a href="#"><h4><?php echo $r[4]; ?></h4></a>
                    <!--noi dung comment-->
                    <div class="emotion" style="display: block" ><?php echo $r[1]; ?></div>
                    <?php 
                    if(isset($_COOKIE['ma_user'])){
                    if($_COOKIE['ma_user'] == $r[3]){
                    echo "<p class='clear'><small><a href='index.php?page=xoa_cmt&ma_comment=$r[0]&ma_bai_viet=$mabv'>Xóa</a>"; }
                    }
                    ?>
<!--                            - <a href="">Share</a></small></p>-->
                </div>
       

                
                
<?php 
            }
        }
?>
        </section>
    </div>
</body>
</html>

