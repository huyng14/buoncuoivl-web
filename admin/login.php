<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>LOGING IN</title>

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
    
	
<div class="login-page bk-img" style="background-image: url(../img/login-bg.jpg);">
    <div class="form-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h1 class="text-center text-bold text-light mt-4x">Sign in</h1>
                    <div class="well row pt-2x pb-3x bk-light">
                        <div class="col-md-8 col-md-offset-2">
                            <form action="" method="POST" class="mt">

                                <label for="" class="text-uppercase text-sm">Your Username</label>
                                <input type="text" name="txtName" placeholder="Username" class="form-control mb">

                                <label for="" class="text-uppercase text-sm">Password</label>
                                <input type="password" name="txtPass" placeholder="Password" class="form-control mb">
                                
<?php 
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        include '../config/connect.php';
//            $db= new PDO("mysql:host= localhost;dbname=buoncuoi","root","");
        $userName= $_POST['txtName'];
        $pass= md5($_POST['txtPass']);

        $query= "SELECT * FROM user WHERE ten_user= '$userName' AND password='$pass' AND loai_user=1 AND trang_thai=1" ;
        $rows= $db->query($query);
        if($rows != NULL){
            $r= $rows->fetch();
        }

        if($r != null){
            session_start();
            
            $_SESSION['admin_buoncuoi']='logged';
            $_SESSION['tenUser']= $userName;
            $_SESSION['maUser']= $r[0];
            header('location:index.php');
            
        }
        else {
            echo 'Sai tên đăng nhập hoặc mật khẩu';
        }


    }

?>
                                <div class="checkbox checkbox-circle checkbox-info">
                                        <input id="checkbox7" type="checkbox" checked>
                                        <label for="checkbox7">
                                                Keep me signed in
                                        </label>
                                </div>
                                
                                <button class="btn btn-primary btn-block" type="submit">LOGIN</button>

                            </form>
                        </div>
                    </div>
                    <div class="text-center text-light">
                            <a href="#" class="text-light">Forgot password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    


	
        
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

</body>

</html>