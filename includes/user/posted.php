<?php

    $baivietQuery = $db->query("
        SELECT
            bai_viet.ma_bai_viet,
            bai_viet.link,
            bai_viet.loai_file,
            bai_viet.tieu_de,
            bai_viet.ngay_tao,
            user.biet_danh,
            user.ma_user
        FROM bai_viet
        
        
        JOIN user
        ON bai_viet.ma_user= {$_COOKIE['ma_user']}
            AND user.ma_user= {$_COOKIE['ma_user']}
                
        WHERE bai_viet.trang_thai=1
        

        GROUP BY bai_viet.ma_bai_viet

        ");
        
        if($row = $baivietQuery->fetch(PDO::FETCH_OBJ))
        {
            $baiviet[]=$row;
            while($row = $baivietQuery->fetch(PDO::FETCH_OBJ))
            {
                $baiviet[] = $row;
            }
        
       
            
        
?>
    <h1>Bài viết đã đăng </h1>
    <?php for($i=0; $i<count($baiviet); $i++):
        //Dem so LIKE
        $query="
                SELECT 
                    thich.like_dislike,
                    COUNT(thich.like_dislike) AS likes
                FROM thich
                WHERE thich.like_dislike=1 AND thich.ma_bai_viet=
                ";
        $query.=$baiviet[$i]->ma_bai_viet;
                
        $baiviet_like = $db-> query($query) or die($db->errorInfo()[2]);
        if($baiviet_like != NULL)
            $row1= $baiviet_like->fetch();
        
        ////Dem so DISLIKE
        $query1="
                SELECT 
                    thich.like_dislike,
                    COUNT(thich.like_dislike) AS dislikes
                FROM thich
                WHERE thich.like_dislike=0 AND thich.ma_bai_viet=
                ";
        $query1.=$baiviet[$i]->ma_bai_viet;
                
        $baiviet_dislike = $db-> query($query1) or die($db->errorInfo()[2]);
        if($baiviet_dislike != NULL)
            $row2= $baiviet_dislike->fetch();
            
        $NumOfLikes = $row1[1];
        $NumOfDislikes = $row2[1];
        $TotalRatings = $NumOfLikes + $NumOfDislikes; 
        if ($NumOfLikes <= 0 && $NumOfDislikes <= 0)
        {
            $LikesPercentage = 50;
            $DislikesPercentage = 50;
        }
        else if($NumOfLikes>0 || $NumOfDislikes >0) {
        $LikesCal = $row1[1] / $TotalRatings;
        $LikesPercentage = $LikesCal * 100;

        $DislikesCal = $row2[1] / $TotalRatings;
        $DislikesPercentage = $DislikesCal * 100; }
    ?>
        
<article>
    <a name="<?php echo $baiviet[$i]->ma_bai_viet; ?>" href="../../index.php?page=detail&ma_bai_viet=<?php echo $baiviet[$i]->ma_bai_viet; ?>"><h2><?php echo $baiviet[$i]->tieu_de; ?></h2></a>
            <?php           
            if($baiviet[$i]->loai_file==0)
            {
                $linkAnh="../../images/anh/".$baiviet[$i]->link;
                echo "<div class='article-info'>";
            ?>    
    <a href="../../index.php?page=detail&ma_bai_viet=<?php echo $baiviet[$i]->ma_bai_viet; ?>"> <p><img src='<?php echo $linkAnh; ?>' width='100%' height='100%'><p> </a>
                 Posted on <time datetime='2013-05-14'><?php echo $baiviet[$i]->ngay_tao; ?></time> by <a href='#' rel='author'><?php echo $baiviet[$i]->biet_danh; ?></a>                
                 </div>
            
            <?php
            }
            else if($baiviet[$i]->loai_file==1)
            {
            ?>
            <div class="article-info">
            <p><iframe width='100%' height='450px' src='<?php echo $baiviet[$i]->link;?>' frameborder='0' allowfullscreen></iframe></p>
            Posted on <time datetime="2013-05-14"><?php echo $baiviet[$i]->ngay_tao; ?></time> by <a href="#" rel="author"><?php echo $baiviet[$i]->biet_danh; ?></a>
            </div>
            <?php 
            }
            ?>
            
            <div style="float:left; background-color:green; width:<?php echo $LikesPercentage; ?>%; height:30px;"></div>
            <div style="float:right; background-color:red; width:<?php echo$DislikesPercentage; ?>%; height:30px;"></div>      
            
            <p><?php echo $row1[1]; ?> người thích bài này.</p>           
            <p><?php echo $row2[1] ; ?> người không thích bài này</p>
<!--            <a href="../../like.php?type=baiviet&ma_bai_viet=<?php echo $baiviet[$i]->ma_bai_viet; ?>" class="button">Thích</a>
            <a href="../../dislike.php?type=baiviet&ma_bai_viet=<?php echo $baiviet[$i]->ma_bai_viet; ?>" class="button button-reversed">Không thích</a>-->
            <a href="setting.php?page=xoabv&ma_bai_viet=<?php echo $baiviet[$i]->ma_bai_viet; ?>" class="button">Xóa</a>
            
            
      
            
</article>
        
    <?php 
            endfor; 
        } 
        else {
            echo 'Không có bài viết nào!!';
        }
    ?>
        
 
        
   