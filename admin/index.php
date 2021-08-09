<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Trang quản lý</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="../css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="../css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="../css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="../css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="../css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="../css/style.css">

	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <?php 
        session_start();
        ob_start();
        
        include '../config/connect.php';
        
        if(isset($_SESSION['admin_buoncuoi']) && $_SESSION['admin_buoncuoi']== 'logged')
        {
    ?>
    <div class="brand clearfix">
            <a href="index.php" class="logo"><img src="../img/logo.jpg" class="img-responsive" alt=""></a>
            <span class="menu-btn"><i class="fa fa-bars"></i></span>
            <ul class="ts-profile-nav">
<!--                    <li><a href="#">Help</a></li>
                    <li><a href="#">Settings</a></li>-->
                    <li class="ts-account">
                            <a href="index.php"><img src="../img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> <?php echo $_SESSION['tenUser']; ?> <i class="fa fa-angle-down hidden-side"></i></a>
                            <ul>
                                    <li><a href="index.php?page=tttk&maTK=<?php echo $_SESSION['maUser'] ?>">Thông tin tài khoản</a></li>
                                    <li><a href="index.php?page=tdmk&maTK=<?php echo $_SESSION['maUser'] ?>">Thay đổi mật khẩu</a></li>
                                    <li><a href="logout.php">Logout</a></li>
                            </ul>
                    </li>
            </ul>
    </div>

    <div class="ts-main-content">
            <nav class="ts-sidebar">
                    <ul class="ts-sidebar-menu">
                            <li class="ts-label">Search</li>
                            <li>
                                    <input type="text" class="ts-sidebar-search" placeholder="Search here...">
                            </li>
                            <li class="ts-label">Main</li>
                            <li class="open"><a href="index.php?page=dash"><i class="fa fa-dashboard"></i>Bài chờ duyệt</a></li>
                            <li><a href="#"><i class="fa fa-table"></i>Danh mục</a>
                                <ul>
                                        <li><a href="index.php?page=dsdm">Danh sách danh mục</a></li>
                                        <li><a href="index.php?page=nhapdm">Thêm danh mục</a></li>
                                </ul>
                            </li>

                            <li><a href="#"><i class="fa fa-table"></i>Bài viết</a>
                                <ul>
                                        <li><a href="index.php?page=dsbv">Danh sách bài viết</a></li>
                                        <li><a href="index.php?page=dang_anh">Đăng ảnh</a></li>
                                        <li><a href="index.php?page=dang_video">Đăng video</a></li>
                                </ul>
                            </li>

                            <li><a href="#"><i class="fa fa-table"></i>User</a>
                                <ul>
                                        <li><a href="index.php?page=ds_user">Danh sách user</a></li>
                                        <li><a href="index.php?page=nhap_user">Thêm user</a></li>
                                </ul>
                            </li>

<!--                            <li><a href="#"><i class="fa fa-table"></i>Comment</a>
                                <ul>
                                        <li><a href="index.php?page=dscmt">Danh sách comment</a></li>
                                        <li><a href="index.php?page=nhap_cmt">Thêm comment</a></li>
                                        
                                </ul>
                            </li>-->

<!--                            <li><a href="#"><i class="fa fa-sitemap"></i> Multi-Level Dropdown</a>
                                    <ul>
                                            <li><a href="#">2nd level</a></li>
                                            <li><a href="#">2nd level</a></li>
                                            <li><a href="#">3rd level</a>
                                                    <ul>
                                                            <li><a href="#">3rd level</a></li>
                                                            <li><a href="#">3rd level</a></li>
                                                    </ul>
                                            </li>
                                    </ul>
                            </li>
                            <li><a href="#"><i class="fa fa-files-o"></i> Sample Pages</a>
                                    <ul>
                                            <li><a href="blank.html">Blank page</a></li>
                                            <li><a href="login.html">Login page</a></li>
                                    </ul>
                            </li>-->

                            <!-- Account from above -->
                            

                    </ul>
            </nav>
            <div class="content-wrapper">
                    <div class="container-fluid">
                        <?php 
                            if(isset($_REQUEST['page']))
                            {
                                $page= $_REQUEST['page'];
                                switch ($page)
                                {
                                //User
                                case 'nhap_user':
                                    include 'user/nhap_user.php';
                                    break;
                                case 'xoa_user':
                                    include 'user/xoa_user.php';
                                    break;
                                case 'sua_user':
                                    include 'user/sua_user.php';
                                    break;
                                case 'ds_user':
                                    include 'user/ds_user.php';
                                    break;
                                
                                //Bai viet
                                case 'dang_anh':
                                    include 'baiviet/dang_anh.php';
                                    break;
                                case 'dang_video':
                                    include 'baiviet/dang_video.php';
                                    break;
                                case 'sua_anh':
                                    include 'baiviet/sua_anh.php';
                                    break;
                                case 'sua_video':
                                    include 'baiviet/sua_video.php';
                                    break;
                                case 'xoabv':
                                    include 'baiviet/xoabv.php';
                                    break;
                                case 'dsbv':
                                    include 'baiviet/dsbv.php';
                                    break;
                                case 'uploaded':
                                    include 'baiviet/upload_bv.php';
                                
                                //Danh muc
                                case 'dsdm':
                                    include 'danhmuc/dsdm.php';
                                    break;
                                case 'nhapdm':
                                    include 'danhmuc/nhap_danh_muc.php';
                                    break;
                                case 'suadm':
                                    include 'danhmuc/suadm.php';
                                    break;
                                case 'xoadm':
                                    include 'danhmuc/xoadm.php';
                                    break;
                                
                                //Comment
                                case 'dscmt':
                                    include 'comment/dscmt.php';
                                    break;
                                case 'nhap_cmt':
                                    include 'comment/nhap_cmt.php';
                                    break;
                                case 'xoa_cmt':
                                    include 'comment/xoa_cmt.php';
                                    break;
                                case 'sua_cmt':
                                    include 'comment/sua_cmt.php';
                                    break;
                                
                                case 'dash':
                                    include './dashboard.php';
                                    break;
                                case 'tttk':
                                    include './user/account.php';
                                    break;
                                case 'tdmk':
                                    include './user/password.php';
                                    break;
                                }
                            }
                            else {
                                include 'dashboard.php';
                            }
                        ?>

                    </div>
            </div>
    </div>
    
    <?php
        }
        else {
            header('location:login.php');
        }
    ?>

    <!-- Loading Scripts -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap-select.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap.min.js"></script>
    <script src="../js/Chart.min.js"></script>
    <script src="../js/fileinput.js"></script>
    <script src="../js/chartData.js"></script>
    <script src="../js/main.js"></script>

    <script>

    window.onload = function(){

            // Line chart from swirlData for dashReport
            var ctx = document.getElementById("dashReport").getContext("2d");
            window.myLine = new Chart(ctx).Line(swirlData, {
                    responsive: true,
                    scaleShowVerticalLines: false,
                    scaleBeginAtZero : true,
                    multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
            }); 

            // Pie Chart from doughutData
            var doctx = document.getElementById("chart-area3").getContext("2d");
            window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});

            // Dougnut Chart from doughnutData
            var doctx = document.getElementById("chart-area4").getContext("2d");
            window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});

    }
    </script>
    
  

</body>

</html>