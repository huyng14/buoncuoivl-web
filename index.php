<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BuoncuoiVL</title>

<script type="text/javascript" src="js/captcha.js"></script>
<link rel="stylesheet" href="css/css/reset.css" type="text/css" />
<link rel="stylesheet" href="css/css/styles.css" type="text/css" />
<link rel="stylesheet" href="css/css/font-awesome.min.css" type="text/css" />



<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<script type="text/javascript" src="js/js/jquery.js"></script>
<script type="text/javascript" src="js/js/slider.js"></script>
<script type="text/javascript" src="js/js/superfish.js"></script>
<script type="text/javascript" src="js/js/custom.js"></script>

 
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jemotion.js"></script>


<!--<script type="text/javascript" src="js/jqueryUI/jquery-1.12.4.js"></script>
<script type="text/javascript" src="js/jqueryUI/jquery-ui.js"></script>-->


<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

<!--
spark, a free CSS web template by ZyPOP (zypopwebtemplates.com/)

Download: http://zypopwebtemplates.com/

License: Creative Commons Attribution
//-->

<?php 
    ob_start();
    include './config/connect.php';
    
    
?>
</head>
<body>
<div id="container">

    <header> 
	<div class="width">
            <h1><a href="index.php">buoncuoi<strong>vl</strong></a></h1>
            <nav>
                <ul class="sf-menu dropdown" style="width: 670px">
                    <li class="selected"><a href="index.php">Trang chủ</a></li>
                    <li><a href="index.php?page=hot">Đang hot</a></li>
                    <li>
                        <a href="#">Danh mục</a>
                        <ul>
                        <?php
                        $danhmuc = "select ma_danh_muc, ten_danh_muc from danh_muc";
                        $rows=$db->query($danhmuc);
                        foreach($rows as $r){                                                  
                        ?>                    
                            <li><a href="index.php?page=danh_muc&ma_danh_muc=<?php echo $r[0]; ?>"><?php echo $r[1]; ?></a></li>
                        <?php } ?>
                        </ul>
                    </li>
                    <li><a href="#">Đăng bài</a>
                        <ul>
                            <li><a href="index.php?page=dang_anh">Ảnh</a></li>
                            <li><a href="index.php?page=dang_video">Video</a></li>
                        </ul>
                    </li>    
                    <?php 
                        if(isset($_COOKIE['admin_buoncuoi']))
                        { 
                    ?>
                            <li>
                                <a href="#"><?php if(isset($_COOKIE['admin_buoncuoi']))
                                        { 
                                            echo $_COOKIE['tenUser'];
                                        }
                                        ?>
                                </a>
                                <ul>
                                        <li><a href="includes/user/setting.php">Tùy chỉnh</a></li>
                                        <li><a href="logout.php">Đăng xuất</a></li>
                                </ul>
                            </li>
                    <?php 
                        }
                        else {
                            echo '<li><a href="login.php">Đăng nhập</a></li>';
                            echo '<li><a href="index.php?page=register">Đăng ký thành viên</a></li>';
                        }
                    ?>                   
                </ul>


                <div class="clear"></div>
            </nav>
       	</div>

    <div class="clear"></div>

       
    </header>

    <div id="body" class="width">
        <section id="content" class="two-column with-right-sidebar">
             <?php
            if(isset($_REQUEST['page']))
        {
            $page= $_REQUEST['page'];
            switch ($page)
            {           
            case 'detail':
                include 'includes/detail.php';
                break;         
            case 'dang_anh':
                include 'includes/dang_anh.php';
                break;
            case 'dang_video':
                include 'includes/dang_video.php';
                break;
            case 'danh_muc':
                include 'includes/danh_muc.php';
                break;
            case 'hot':
                include 'includes/hot.php';
                break;
            case 'xoa_cmt':
                include 'includes/xoa_cmt.php';
                break;
            case 'register':
                include './includes/dang_ki.php';
                break;
            }
        }
    else{
        include 'includes/center.php';
    }       
          ?>  
            
        </section>
        
        
        
        <aside class="sidebar big-sidebar right-sidebar">
            <?php include 'includes/aside.php'; ?>
            
        </aside>
        
    	<div class="clear"></div>
    </div>

    
    <footer>
        <div class="footer-content width">
            <ul>
            	<li><h4>Huy</h4></li>
<!--                <li><a href="mailto:C1602L999@aprotrain.com">email</a></li>
                <li><a href="#">Blandit elementum</a></li>
                <li><a href="#">Proin placerat accumsan</a></li>
                <li><a href="#">Morbi hendrerit libero </a></li>
                <li><a href="#">Curabitur sit amet tellus</a></li>-->
            </ul>
            
            <ul>
            	<li><h4>Minh</h4></li>
<!--                <li><a href="#">Curabitur sit amet tellus</a></li>
                <li><a href="#">Morbi hendrerit libero </a></li>
                <li><a href="#">Proin placerat accumsan</a></li>
                <li><a href="#">Rutrum nulla a ultrices</a></li>
                <li><a href="#">Cras dictum</a></li>-->
            </ul>

 	    <ul>
                <li><h4>Mai Tú</h4></li>
<!--                <li><a href="#">Morbi hendrerit libero </a></li>
                <li><a href="#">Proin placerat accumsan</a></li>
                <li><a href="#">Rutrum nulla a ultrices</a></li>
                <li><a href="#">Curabitur sit amet tellus</a></li>
                <li><a href="#">Donec in ligula nisl.</a></li>-->
            </ul>
            
            <ul class="endfooter">
            	<li><h4>Anh Tú</h4></li>
<!--                <li>Integer mattis blandit turpis, quis rutrum est. Maecenas quis arcu vel felis lobortis iaculis fringilla at ligula. Nunc dignissim porttitor dolor eget porta. <br /><br />

                    <div class="social-icons">

                        <a href="#"><i class="fa fa-facebook fa-2x"></i></a>

                        <a href="#"><i class="fa fa-twitter fa-2x"></i></a>

                        <a href="#"><i class="fa fa-youtube fa-2x"></i></a>

                        <a href="#"><i class="fa fa-instagram fa-2x"></i></a>

                    </div>-->

                </li>
            </ul>
            
            <div class="clear"></div>
        </div>
        <div class="footer-bottom">
            <p>Web đưa tin buồn cười số 1 Việt Nam</p>
        </div>
    </footer>
</div>
</body>
</html>