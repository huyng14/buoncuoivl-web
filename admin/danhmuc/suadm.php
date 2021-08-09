<?php
    
          
    if(isset($_REQUEST['ma_danh_muc']))
    {
        $madm = $_REQUEST['ma_danh_muc'];
        
        
        
        $q = "select * from danh_muc where ma_danh_muc=$madm";
        
        $rows = $db->query($q);
        if($rows!=null)
            $r=$rows->fetch ();
        
        
        
        if($_SERVER['REQUEST_METHOD']=='POST') //Nhan nut submit
        {
            $tendm = $_POST['txtTenDM'];
            
            $tt = $_POST['txtTT'];
            
            $trt = 0;   //An
            if(isset($_POST['cbTT']))
            {
                $trt=1; //Hien
            }
            
           
            
            //2. Truy van sql
            $query = "update danh_muc set ten_danh_muc='$tendm', thu_tu=$tt, trang_thai=$trt where ma_danh_muc=$madm";
            
            //3. Thuc thi: insert, update, delete => $db->exec(...);
            $count=$db->exec($query);
            
            //4. Kiem tra Kq
            if($count>0)
            {
                header('location: index.php?page=dsdm');
            }
        }
        
        
    }
    
    
    
?>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
                <div class="panel-heading">Thông tin danh mục</div>
                <div class="panel-body">
                    <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                            <label class="col-sm-2 control-label">Tên danh mục: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="txtTenDM" value="<?php if(isset($r)) echo $r[3]; ?>"/>
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
                                <input type="text" class="form-control" name="txtTT"  value="<?php if(isset($r)) echo $r[1]; ?>">  
                            </div>
                    </div>

                   <label class="col-sm-2 control-label">Trạng thái: 
                        <br>
                        <br>
                    </label>
                    <div class="col-sm-10">
                        <div class="checkbox checkbox-success">

                            <input id="checkbox3" type="checkbox" name="cbTT"  <?php if(isset($r) && $r[2]==1) echo 'checked'; ?>>
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