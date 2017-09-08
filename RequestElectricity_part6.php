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
        $read="required";
?>

    <div id="page-wrapper">
        <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">คำร้องขอใช้ไฟฟ้า</h2>
                </div>
            <div class="panel-body">

            <form method="post" action="RequestElectricity_Ses.php?mode=RequestElectricity_part6">
                <?php
                    $new_id =mysql_result(mysql_query("Select Max(substr(re_id,-4))+1 as MaxID from tb_electricity"),0,"MaxID" );
                    if($new_id==''){
                        $re_id="120000000001";
                    }else{
                        $re_id="12".sprintf("%010d",$new_id);
                    }
                ?>
				<div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>เลขที่คำร้อง</label>
                        <input class="form-control" autocomplete=off  name="re_id" type="text" id="re_id" value="<?=$re_id?>" size="30" readonly/>
                        <input  type="hidden" class="form-control "  name="re_id" id="re_id" value="<?=$re_id?>">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>กฟฟ(สาขา).</label>
                            <input  type="text" class="form-control "  value="<?=$_SESSION['rg_branch']?>"readonly>	
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>เจ้าหน้าที่ผู้รับคำร้อง</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="user_id" type="text" id="user_id" value="<?=$user[user_name]?> <?=$user[user_last]?>" readonly/>	
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>วัน/เดือน/ปี</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_date" type="text" id="re_date" value="<?=date("d/m/").(date("Y")+543)?>"  readonly/>	
                        </div>
                    </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>7.กำหนดการใช้ไฟฟ้า</label>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="form-group col-sm-6">
                                <div class="form-group ">
                                    <input type="date" class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_dateset" value="<?=$_SESSION['re_dateset']?>" required>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-5 form-group">
                            <label>6.ผู้ขอใช้ไฟฟ้ามีความประสงค์ที่จะชำระเงินค่าไฟฟ้าประจำเดือนด้วย</label>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="radio-inline">
                                <label><input name="re_keep_type" size="30" type="radio" value="0" id="re_keep_type" required>เงินสด</label>
                            </div>
                            <div class="radio-inline">
                                <label><input name="re_keep_type" size="30" type="radio" value="1" id="re_keep_type2">หักจากบัญชีธนาคาร</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>ทั้งนี้ กฟภ. สามารถเรียกเก็บเงินค่ากระแสไฟฟ้าดังกล่าวได้จาก</label>
                            <textarea class="form-control"  rows="1" id="re_place_name" placeholder="กรุณากรอกข้อมูล" name="re_keep_name" required></textarea>
                        </div>
                        <div class="form-group col-sm-12">
                            <input type="checkbox" id="checkbox-place"><b> ใช้ที่อยู่เดียวกับที่อยู่ผู้ใช้ไฟฟ้า</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <b>ที่อยู่:</b> <label>รหัสบ้าน</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_keep_homeid" type="text" id="re_keep_homeid"  required/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>เลขที่</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_keep_number" type="text" id="re_keep_number" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>หมู่บ้าน/อาคาร</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_keep_village" type="text" id="re_keep_village"  required/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ห้อง</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_keep_room" type="text" id="re_keep_room"  required/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ชั้น</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_keep_floor" type="text" id="re_keep_floor"  required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตรอก</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_keep_alley" type="text" id="re_keep_alley" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>ซอย</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_keep_alleyway" type="text" id="re_keep_alleyway"  required/>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>ถนน</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_keep_road" type="text" id="re_keep_road"  required/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>หมู่ที่</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_keep_villno" type="text" id="re_keep_vilno" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตำบล</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_keep_district" type="text" id="re_keep_district"  required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>อำเภอ</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_keep_canton" type="text" id="re_keep_canton"  required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>จังหวัด</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_keep_province" type="text" id="re_keep_province"  required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>รหัสไปรษณีย์</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_keep_post" type="text" id="re_keep_post" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>โทรศัพท์</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_keep_tel" type="text" id="re_keep_tel" onkeyup="IsNumeric(this.value,this)" maxlength="10" required/>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>โทรสาร/Fax</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_keep_fax" type="text" id="re_keep_fax"  onkeyup="IsNumeric(this.value,this)" maxlength="10" required/>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>E-mail</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_keep_email" type="text" id="re_keep_email"  required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>แผนที่สังเขป</label>
                            <input class="form-control"  name="file" type="file" required/>
                        </div>
                    </div>
                    <center>
                        <button class="btn  btn-success" name="Submit" type="submit"><i class="fa fa-check"> บันทึก</i></button>
                        <input name="txtid" type="hidden" id="txtid" value="<?=$id?>" />
                        <a class="btn btn-info" onclick="location.href='RequestElectricity.php'"><i class="fa fa-times"> ยกเลิก</i></a>	
                    </center>
                </div>
                    <center>
                        <input  type="hidden" class="form-control " name="newcus" id="add" value="addcus">
                        <a class="btn btn-info" onclick="location.href='RequestElectricity_part6.php'"><i class="fa fa-arrow-left"> ย้อนกลับ</i></a>
                        <button class="btn  btn-success" name="Submit" type="submit"><i class="fa fa-arrow-right"> ถัดไป</i></button>	
                    </center>
                </div>
            </form> 
        </div>

				
            </div>
        </div>
</body>

</html>
