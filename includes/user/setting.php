<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>spark - Free CSS Template by ZyPOP</title>

<script src='https://www.google.com/recaptcha/api.js'></script>
<link rel="stylesheet" href="../../css/css/reset.css" type="text/css" />
<link rel="stylesheet" href="../../css/css/styles.css" type="text/css" />
<link rel="stylesheet" href="../../css/css/css/font-awesome.min.css" type="text/css" />



<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->


<script type="text/javascript" src="../../js/js/jquery.js"></script>
<script type="text/javascript" src="../../js/js/slider.js"></script>
<script type="text/javascript" src="../../js/js/superfish.js"></script>
<script type="text/javascript" src="../../js/js/custom.js"></script>


<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

<!--
spark, a free CSS web template by ZyPOP (zypopwebtemplates.com/)

Download: http://zypopwebtemplates.com/

License: Creative Commons Attribution
//-->


<?php 
ob_start();
    include '../../config/connect.php';
    if(isset($_COOKIE['admin_buoncuoi'])){
        
    
?>
</head>
<body>
<div id="container">

    <header> 
        <div class="width">
            <h1><a href="../../index.php">buoncuoi<strong>vl</strong></a></h1>
            <nav>
                <ul class="sf-menu dropdown" style="width: 670px">
                    <li class="selected"><a href="../../index.php">Trang chủ</a></li>
                    <li><a href="setting.php?page=hot">Hot</a></li>
                    <li>
                        <a href="#">Danh mục</a>
                        <ul>
                        <?php
                        $danhmuc = "select ma_danh_muc, ten_danh_muc from danh_muc";
                        $rows=$db->query($danhmuc);
                        foreach($rows as $r){                                                  
                        ?>                    
                            <li><a href="setting.php?page=danh_muc&ma_danh_muc=<?php echo $r[0]; ?>"><?php echo $r[1]; ?></a></li>
                        <?php } ?>
                        </ul>
                    </li>
                    <li><a href="#">Đăng bài</a>
                        <ul>
                            <li><a href="setting.php?page=dang_anh">Ảnh</a></li>
                            <li><a href="setting.php?page=dang_video">Video</a></li>
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
                                    <li><a href="setting.php">Tùy chỉnh</a></li>
                                    <li><a href="../../logout.php">Đăng xuất</a></li>
                                </ul>
                            </li>
                    <?php 
                        }
                        else {
                            echo '<li><a href="login.php">Đăng nhập</a></li>';
                        }
                    ?>                   
                </ul>


                <div class="clear"></div>
            </nav>
       	</div>

    <div class="clear"></div>
    </header>


    <div id="body" class="width">


<aside class="sidebar big-sidebar left-sidebar">
	
            <ul >	
               <li>
                    <h4>Thông tin tài khoản</h4>
                    <ul class="dropdown">
                        <li><a href="setting.php?page=account">Tài khoản</a></li>
                        <li><a href="setting.php?page=pass">Mật khẩu</a></li>
                        <li>Hồ sơ
                            <ul>
                                <li><div><a href="setting.php?page=post">Bài viết đã đăng</a></div></li>
                                <li><div><a href="setting.php?page=queue">Bài viết đang chờ duyệt</a></div></li>
                            </ul>
                        </li>
                        
                    </ul>
                </li>
                
                
            </ul>
		
        </aside>



        <section id="content" class="two-column with-left-sidebar">


            <?php 
                if(isset($_REQUEST['page'])){
                    $page= $_REQUEST['page'];
                    switch ($page){
                        case 'account':
                            include './account.php';
                            break;
                        case 'pass':
                            include './password.php';
                            break;
                        case 'post':
                            include './posted.php';
                            break;
                        case 'queue':
                            include './queue.php';
                            break;
                        case 'dang_anh':
                            include './dang_anh.php';
                            break;
                        case 'dang_video':
                            include './dang_video.php';
                            break;
                        case 'danh_muc':
                            include './danh_muc.php';
                            break;
                        case 'hot':
                            include './hot.php';
                            break;
                        case 'xoabv':
                            include './xoabv.php';
                            break;
                        case 'xoabvchuakd':
                            include './xoabvchuakd.php';
                            break;
                    }
                }
                else {
                    include './account.php';
                }
            ?>
        </section>
        
        
    	<div class="clear"></div>
    </div>
</div>
</body>
</html>
<?php 
    }
    else {
        header("location: ../../login.php");
    }
?>