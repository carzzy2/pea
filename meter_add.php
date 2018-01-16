<?php
@session_start();
include "connect_db.php";
$ses_userid =$_SESSION[ses_userid];
$ses_username = $_SESSION[loginid];
	if($ses_userid <> session_id() or $ses_username ==""){
		echo "<script>alert('กรุณาลงชื่อเข้าสู่ระบบก่อน');</script>";
		echo "<meta http-equiv='refresh' content='0;URL=login.php' />";
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PEA</title>
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet"><!-- Bootstrap Core CSS -->
    <link href="vendor/metisMenu/metisMenu.css" rel="stylesheet"><!-- MetisMenu CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet"><!-- Custom CSS -->
    <link href="vendor/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"><!-- Custom Fonts -->
    <script src="vendor/jquery/jquery.min.js"></script><!-- jQuery -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script><!-- Bootstrap Core JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script><!-- Metis Menu Plugin JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script><!-- Custom Theme JavaScript -->

</head>

<body>
<?php include "header.php";?>

<?php
    include"sidebar.php"; 
?>
 <?php
if($_GET[mode]==""){
	$mode="add";
	$str="เพิ่มข้อมูล";
}elseif($_GET[mode]=="edit"){
	$enable="disabled=disabled";
	$mode=$_GET[mode];
	$id=$_GET[id];
	$str="แก้ไข";
	$sql_edit="select * from tb_meter where me_id='".$id."'";
	$result_edit=mysql_db_query($dbname,$sql_edit);
	$array_edit=mysql_fetch_array($result_edit);
}
?>
    <div id="page-wrapper">
        <div class="col-sm-12 ">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title"><?=$str?>ประเภทมิเตอร์</h2>
                </div>
            <div class="panel-body">
            <div class="col-sm-12">
                <div class="row">
            <form method="post"  action="meter_save.php" >
                <?php
                    $new_id =mysql_result(mysql_query("Select Max(substr(me_id,-4))+1 as MaxID from tb_meter"),0,"MaxID" );
                    if($new_id==''){ // ถ้าได้เป็นค่าว่าง หรือ null ก็แสดงว่ายังไม่มีข้อมูลในฐานข้อมูล
                    $std_id="ME00001";
                    }else{
                    $std_id="ME".sprintf("%05d",$new_id);//ถ้าไม่ใช่ค่าว่าง
                    }
                ?>
                <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>รหัสมิเตอร์</label>
                            <?php if($_GET[mode]=="edit"){ ?>
                            <input placeholder="กรุณากรอกข้อมูล" size="30" class="form-control" name="me_id" type="text" id="me_id" value="<?=$array_edit[me_id]?>"<?=$enable?>/>
                            <input  type="hidden" class="form-control "  name="me_id" id="me_id" value="<?=$array_edit[me_id]?>">
                            <?php }elseif($_GET[mode]==""){ ?>
                            <input class="form-control" autocomplete=off  name="me_id" type="text" id="me_id" value="<?=$std_id?>" size="30" readonly/>
                            <?php } ?>	
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>ขนาดมิเตอร์</label>
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="me_name" type="text" id="me_name" value="<?=$array_edit[me_name]?>" required/>	
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>ราคา</label>
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="me_price" type="number"  id="me_price" value="<?=$array_edit[me_price]?>" min="0" required>	
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>ค่ามัดจำ</label>
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="me_insure" type="number"  id="me_price" value="<?=$array_edit[me_insure]?>" min="0" required>	
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <label>วัตถุประสงค์</label>
                                <select id="me_type" class="form-control" name="me_type" required>
                                    <option value=""><-- เลือกวัตถุประสงค์ --></option>
                                    <option value="0" <?php if($array_edit['me_type']=="0"){echo "selected=selected";}?>>ขอติดตั้งมิเตอร์ใหม่</option>
                                    <option value="2" <?php if($array_edit['me_type']=="2"){echo "selected=selected";}?>>ขอต่อกลับการใช้ไฟฟ้า</option>
                                    <option value="3" <?php if($array_edit['me_type']=="3"){echo "selected=selected";}?>>ขอเพื่มขนาดมิเตอร์/อุปกรณ์ประกอบ</option>
                                    <option value="4" <?php if($array_edit['me_type']=="4"){echo "selected=selected";}?>>ขอเปลี่ยนประเภทมิเตอร์</option>                        
                                    <option value="7" <?php if($array_edit['me_type']=="7"){echo "selected=selected";}?>>ขอติดตั้งไฟฟ้าชั่วคราว</option>
                                    <option value="10" <?php if($array_edit['me_type']=="10"){echo "selected=selected";}?>>ขอลดขนาดมิเตอร์/อุปกรณ์ประกอบ</option>
                                    <option value="11" <?php if($array_edit['me_type']=="11"){echo "selected=selected";}?>>ขอใช้ไฟฟ้าสาธารณะ</option>
                                    <option value="12" <?php if($array_edit['me_type']=="12"){echo "selected=selected";}?>>ขอตัดมิเตอร์ใช้เพื่อแสงสว่างลด</option>
                                    <option value="13" <?php if($array_edit['me_type']=="13"){echo "selected=selected";}?>>ขอย้ายจุดติดตั้งมิเตอร์/อุปกรณ์ประกอบ</option>
                                </select>
                            </div>
                        </div>
                    <center>
                        <button class="btn  btn-success" name="Submit" type="submit"><i class="fa fa-check" > <?=$str?></i></button>
                        <input name="txtmode" type="hidden" id="txtmode" value="<?=$mode?>" />
                        <input name="txtid" type="hidden" id="txtid" value="<?=$id?>" />
                        <a class="btn btn-info" onclick="location.href='meter_show.php'"><i class="fa fa-times"> ยกเลิก</i></a>	
                    </center>
                </div>
            </form> 
        </div>
            </div>  					
        </div>
        </div>
    </div>
</div>

</body>

</html>
