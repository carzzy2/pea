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
	$mode=$_GET[mode];
	$id=$_GET[id];
	$str="แก้ไข";
	$sql_edit="select * from tb_customer where cus_id='".$id."'";
	$result_edit=mysql_db_query($dbname,$sql_edit);
	$array_edit=mysql_fetch_array($result_edit);
}
?>
    <div id="page-wrapper">
        <div class="col-sm-12 ">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title"><?=$str?>ผู้ใช้บริการ</h2>
                </div>
            <div class="panel-body">
        <div class="row">
            <form method="post" action="customer_save.php" >
                <div class="col-sm-12 well">
                        <div class="row">
                            <div class="col-sm-3 form-group">
                                <label>คำนำหน้า</label>
                                <select id="cus_first" class="form-control" name="cus_first" required>
                                    <option style="display: none">--กรุณาเลือก--</option>
                                    <option value="0" <?php if($array_edit['cus_first']=="0"){ echo "selected=selected"; }?>>นาย</option>
                                    <option value="1" <?php if($array_edit['cus_first']=="1"){ echo "selected=selected"; }?>>นาง</option>
                                    <option value="2" <?php if($array_edit['cus_first']=="2"){ echo "selected=selected"; }?>>นางสาว</option>
                                </select>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>ชื่อ-นามสกุล</label>
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="cus_name" type="text" id="cus_name" value="<?=$array_edit[cus_name]?>" onkeypress="chThai()" required/>	
                            </div>
                            <div class="col-sm-5 form-group">
                                <label>ประเภทบัตร</label>
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="cus_type" type="text" id="cus_type" value="<?=$array_edit[cus_type]?>" onkeypress="chThai()" required/>	
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>รหัสประชาชน </label>
                            <? if($_GET[mode]=="edit"){ ?>
                            <input  class="form-control" name="cus_id1" type="text" id="cus_id1" value="<?=$array_edit[cus_id]?>" readonly/>
                            <input  type="hidden" class="form-control "  name="cus_id" id="cus_id" value="<?=$array_edit[cus_id]?>">
                            <?}elseif($_GET[mode]==""){ ?>
                            <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" autocomplete=off  name="cus_id" type="text" id="cus_id" value="<?=$array_edit[cus_id]?>" size="30"  onkeyup="IsNumeric(this.value,this)" maxlength="13" required/>
                            <? } ?>	
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>หมายเลขประจำตัวผู้เสียภาษีอากร</label>
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="cus_tax" type="text" id="cus_tax" value="<?=$array_edit[cus_tax]?>" onkeyup="IsNumeric(this.value,this)" maxlength="13" required/>	
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>หมายเลขผู้ใช้ไฟฟ้า</label>
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="cus_code" type="text" id="cus_code" value="<?=$array_edit[cus_code]?>" onkeyup="IsNumeric(this.value,this)" maxlength="9" required/>	
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <b>ที่อยู่:</b> <label>รหัสบ้าน</label>
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="cus_homeid" type="text" id="cus_homeid" value="<?=$array_edit[cus_homeid]?>" required/>
                            </div>
                            <div class="form-group col-sm-2">
                                <label>เลขที่</label>
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="cus_number" type="text" id="cus_number" value="<?=$array_edit[cus_number]?>" required/>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>หมู่บ้าน/อาคาร</label>
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="cus_village" type="text" id="cus_village" value="<?=$array_edit[cus_village]?>" required/>
                            </div>
                            <div class="form-group col-sm-2">
                                <label>ห้อง</label>
                                <input class="form-control"  placeholder="กรุณากรอกข้อมูล" name="cus_room" type="text" id="cus_room" value="<?=$array_edit[cus_room]?>" required/>
                            </div>
                            <div class="form-group col-sm-2">
                                <label>ชั้น</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_floor" type="text" id="cus_floor" onkeyup="IsNumeric(this.value,this)" value="<?=$array_edit[cus_floor]?>" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <label>ตรอก</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_alley" type="text" id="cus_alley" value="<?=$array_edit[cus_alley]?>" required/>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>ซอย</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_alleyway" type="text" id="cus_alleyway" value="<?=$array_edit[cus_alleyway]?>" required/>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>ถนน</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_road" type="text" id="cus_road" value="<?=$array_edit[cus_road]?>" required/>
                            </div>
                            <div class="form-group col-sm-2">
                                <label>หมู่ที่</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_vilno" type="text" id="cus_vilno" value="<?=$array_edit[cus_vilno]?>" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <label>ตำบล</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_district" type="text" id="cus_district" value="<?=$array_edit[cus_district]?>" required/>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>อำเภอ</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_canton" type="text" id="cus_canton" value="<?=$array_edit[cus_canton]?>" required/>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>จังหวัด</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_province" type="text" id="cus_province" value="<?=$array_edit[cus_province]?>" required/>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>รหัสไปรษณีย์</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_post" type="text" id="cus_post" value="<?=$array_edit[cus_post]?>" maxlength="5" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label>โทรศัพท์</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_tel" type="text" id="cus_tel" value="<?=$array_edit[cus_tel]?>" onkeyup="IsNumeric(this.value,this)" maxlength="10" required/>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>โทรสาร/Fax</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_fax" type="text" id="cus_fax" value="<?=$array_edit[cus_fax]?>" onkeyup="IsNumeric(this.value,this)" maxlength="10" required/>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>E-mail</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_email" type="text" id="cus_email" value="<?=$array_edit[cus_email]?>" required/>
                            </div>
                        </div>
                    <center>
                        <button class="btn  btn-success" name="Submit" type="submit"><i class="fa fa-check"> <?=$str?></i></button>
                        <input name="txtmode" type="hidden" id="txtmode" value="<?=$mode?>" />
                        <input name="txtid" type="hidden" id="txtid" value="<?=$id?>" />
                        <a class="btn btn-info" onclick="location.href='customer_show.php'"><i class="fa fa-times"> ยกเลิก</i></a>	
                    </center>
                </div>
            </form> 
        </div>					
        </div>
        </div>
    </div>
</div>
</body>

</html>
