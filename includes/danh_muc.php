<?php
if(isset($_GET['ma_danh_muc']))
{
    $madm = $_GET['ma_danh_muc'];
    $baivietQuery = $db->query("
        SELECT
        bai_viet.ma_danh_muc,
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
        ON bai_viet.ma_bai_viet = thich.ma_bai_viet  AND thich.like_dislike=1 

        LEFT JOIN user
        ON bai_viet.ma_user = user.ma_user
        WHERE bai_viet.ma_danh_muc = $madm AND bai_viet.trang_thai = 1

        GROUP BY bai_viet.ma_bai_viet
        ORDER BY bai_viet.ngay_tao DESC
  

        ") or die ($db->errorInfo()[2]);

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
        ON bai_viet.ma_bai_viet = thich.ma_bai_viet  AND thich.like_dislike=0 

        LEFT JOIN user
        ON bai_viet.ma_user = user.ma_user
        WHERE bai_viet.ma_danh_muc = $madm AND bai_viet.trang_thai = 1

        GROUP BY bai_viet.ma_bai_viet
        ORDER BY bai_viet.ngay_tao
        ") ;

    while($row1 = $baivietQuery1->fetch(PDO::FETCH_OBJ)){
    $baiviet1[] = $row1;
    }
      
?>
        <?php for($i=0; $i<count($baiviet); $i++):
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
       
<article>
    <a name="<?php echo $baiviet[$i]->ma_bai_viet; ?>" href="index.php?page=detail&ma_bai_viet=<?php echo $baiviet[$i]->ma_bai_viet; ?>"><h2><?php echo $baiviet[$i]->tieu_de; ?></h2></a>
            <?php           
            if($baiviet[$i]->loai_file==0)
            {
                $linkAnh="images/anh/".$baiviet[$i]->link;
                echo "<div class='article-info'>";
            ?>    
    <a href="index.php?page=detail&ma_bai_viet=<?php echo $baiviet[$i]->ma_bai_viet; ?>"><p><img src='<?php echo $linkAnh; ?>' width='100%' height='100%'><p></a>
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
            
            <p><?php echo $baiviet[$i]->likes; ?> người thích bài này.</p>           
            <p><?php echo $baiviet1[$i]->dislikes ; ?> người không thích bài này</p>
            <a href="like.php?type=danhmuc&ma_bai_viet=<?php echo $baiviet[$i]->ma_bai_viet; ?>&ma_danh_muc=<?php echo $baiviet[$i]->ma_danh_muc; ?>" class="button">Thích</a>
            <a href="dislike.php?type=danhmuc&ma_bai_viet=<?php echo $baiviet[$i]->ma_bai_viet; ?>&ma_danh_muc=<?php echo $baiviet[$i]->ma_danh_muc; ?>" class="button button-reversed">Không thích</a>
            
            
      
            
</article>
        
<?php endfor; } ?>
        
        
        
   