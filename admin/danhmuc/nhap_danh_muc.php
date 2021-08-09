<html>
    <head>
        <meta charset="UTF-8">
        <title>Nhập bảng user</title>
<!--        <style> 
            span{
                color: red;
                background: yellow;
                font-size: 12 px;
                
            }
        </style>-->
        
    </head>
    <body>
        <?php
         if($_SERVER['REQUEST_METHOD']=='POST')
         {
             
             $tendm = $_POST['txtTenDM'];
             
             $thutu = $_POST['txtTT'];
             
             $trt = 0;
             if(isset($_POST['cbTT']))
             {
                 $trt = 1;
             }
             
             if(empty($_POST['txtTenDM']))
                {
                    $error[] = 'nhapdm';
                }
              if(empty($_POST['txtTT']))
                {
                    $error[] = 'nhaptt';
                }
          
            
            
            
            $query = "insert into danh_muc(thu_tu, ten_danh_muc, trang_thai) values($thutu, '$tendm', $trt)";
            
            
            $count=$db->exec($query);
            
            
            if($count>0)
            {
                echo 'Them moi thanh cong!';
            }                              
                     
         }
        
        ?>
   
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
                <div class="panel-heading">Nhập danh mục</div>
                <div class="panel-body">
                    <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                            <label class="col-sm-2 control-label">Tên danh mục: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="txtTenDM"/>
                                <span>
                                            <?php
                                            if(!empty($error) && in_array('nhapdm', $error))
                                            {
                                                echo 'Yêu cầu nhập danh mục!';
                                            }
                                            ?>
                                        </span>
                            </div>
                    </div>

<!--                                <div class="hr-dashed"></div>
                    <div class="form-group">
                            <label class="col-sm-2 control-label">Help text</label>
                            <div class="col-sm-10">
                                    <input type="text" class="form-control"><span class="help-block m-b-none">A block of help text that breaks onto a new line and may extend beyond one line.</span> </div>
                    </div>-->

                    <div class="hr-dashed"></div>
                    <div class="form-group">
                            <label class="col-sm-2 control-label">Thứ tự</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="txtTT">  
                                <span>
                                            <?php
                                            if(!empty($error) && in_array('nhaptt', $error))
                                            {
                                                echo 'Yêu cầu nhập thứ tự!';
                                            }
                                            ?>
                                        </span>
                            </div>
                    </div>

                   <label class="col-sm-2 control-label">Trạng thái: 
                        <br>
                        <br>
                    </label>
                    <div class="col-sm-10">
                        <div class="checkbox checkbox-success">

                            <input id="checkbox3" type="checkbox" name="cbTT">
                            <label for="checkbox3">
                                Hiện
                            </label>
                        </div>
                    </div>

                    <div class="hr-dashed"></div>
                    <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn btn-default" type="reset">Cancel</button>
                                <button class="btn btn-primary" type="submit">Save changes</button>
                            </div>
                    </div>

            </form>

            </div>
        </div>
    </div>
</div>
</body>
</html>

