<!DOCTYPE>
<html> 
    <header> 
        <meta charset="UTF-8"/>
        <title>Comment </title>
        <link rel="stylesheet" type="text/css" href="binhluancss.css"/>
        <style type="text/css" rel="stylesheet" href="css/style.css"></style>
        <script type="text/javascript" src="jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="jemotion.js"></script>
        
        <script>
            $(document).ready(function(){
                $("#toggle a").click(function(){
                    var text= $(this).attr('title');
                    $("#show-emotion").val($("#show-emotion").val()+text);
                });
            });

        </script>
        
     	 <script>
			function myFunction() {
  		 	 var str = document.getElementById("show-emotion").innerHTML;
   			 var pos = str.indexOf(".jpg");
			
			 if(pos >0)
			 {
				 var link= "<img src='"+ str+ "'/>";
				 	document.getElementById("hienthi").innerHTML = link;
 			 }
   		 else
		 {
			 return;
			 }
			}
		</script>
        
<?php
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $db = new PDO("mysql:host=localhost; dbname=buoncuoi","root",""); 
        $trt = 1;
        
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ngay_tao=date('Y/m/d H:i:s');
        
        $mauser=3;
        $mabv=3;
        $noi_dung=$_POST['txt'];


        $query="insert into comment(ma_bai_viet,ma_user,noi_dung,trang_thai,ngay_tao) values ('$mabv','$mauser','$noi_dung',$trt,'$ngay_tao')";

        $count=$db->exec($query);
    }
?>
        
</header>
    <body> 
          
<!--        <div class="emotion"> >:) :)) /:) <):) :)] :) :(( :( ;;) ;) >:D< :D :-SS #:-S :-? >:P :P (:| :| :-/ :-* =(( ~X( B-) :-S =)) O:-) :-B =; 8-| L-) :-& :-$ [-( :O) 8-} 
        <:-P :x =P~ #-o =D> @-) :^o :-w :-< :-O :> :-c X( :-h 8-> </div>-->
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
        
        
        
       <div class="section box-comment">
	<div load class="fn-dynamic" data-fn="zmp3Comment" data-id="ZW7UBE7W" data-type="song"></div>
	<i class="fn_zme_info" style="display: none;" data_uid="0" data-thumb=".fn-useravatar" data-thumbsize="120"></i>
	<a name="comment" class="none"></a>
	<h3 class="title-section">Bình luận (
		<span id="commentCounter"></span>)
	</h3>
	<form action="" method="POST" class="frm-comment fn-comment" >
		<p class="avatar">
			<img width="80" class="fn-useravatar" src="http://static.mp3.zdn.vn/skins/zmp3-v4.1/images/default2/user_avatar.jpg"/>
		</p>
        <br class="clear-float"/>
		<div class="wrap-comment" >
			<textarea name="txt" id="show-emotion" class="emotion" cols="30" rows="10" placeholder="Write your comment..." ></textarea>
     <a href="http://memeful.com/" target="_blank" id="meme"><img src="images-icon-20641.png"/></a>  
     	<div id="toggle"> 
            <a href="#" title=":)"><img src="emotions/1.png" alt=":)"></a>
            <a href="#" title=":x"><img src="emotions/2.png" alt=":x"></a>
            <a href="#" title=":P"><img src="emotions/3.png" alt=":P"></a>
            <a href="#" title=":o"><img src="emotions/4.png" alt=":o"></a>
            <a href="#" title=":ss"><img src="emotions/5.png" alt=":ss"></a>
            <a href="#" title=":c"><img src="emotions/6.png" alt=":c"></a>
            <a href="#" title=":B"><img src="emotions/7.png" alt=":B"></a>
            <a href="#" title=":v"><img src="emotions/8.png" alt=":v"></a>
            <a href="#" title=":("><img src="emotions/9.png" alt=":("></a>
            
        </div>
			
				<button name="btnSubmit" type="submit" class="button btn-dark-blue pull-right" >Bình luận</button>
			</div>
         
		</form>
		<ul id="commentList" class="list-comment">
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
		</ul>
<!--		<div id="pagination" class="pagination none" data-total="1" data-page="1">
			<ul>
				<li>
					<a class="none fn-first fn-page" data-page="1" href="#comment">Đầu</a>
				</li>
				<li>
					<a class="none fn-prev fn-page" data-page="1" href="#comment">&lt;</a>
				</li>
				<li>
					<a class="none fn-page1 fn-page" data-page="1" href="#comment">1</a>
				</li>
				<li>
					<a class="none fn-page2 fn-page" data-page="2" href="#comment">2</a>
				</li>
				<li>
					<a class="none fn-page3 fn-page" data-page="3" href="#comment">3</a>
				</li>
				<li>
					<a class="none fn-page4 fn-page" data-page="4" href="#comment">4</a>
				</li>
				<li>
					<a class="none fn-page5 fn-page" data-page="5" href="#comment">5</a>
				</li>
				<li>
					<a class="none fn-next fn-page" data-page="5" href="#comment">&gt;</a>
				</li>
				<li>
					<a class="none fn-last fn-page" data-page="5" href="#comment">Cuối</a>
				</li>
			</ul>
		</div>-->
	</div>
      
<?php 
if(($_SERVER['REQUEST_METHOD']=='POST'))
    echo '<div class="emotion" id="hienthi">'. $_POST['txt'].'</div>';
?>
    </body>
</html>