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

            <form method="post" action="RequestElectricity_Ses.php?mode=RequestElectricity_part1">
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
                            <select class="form-control" name="rg_branch" id="rg_branch" <?=$read?>>
                                    <option style="display: none" value="">--กรุณาเลือก--</option>
                                    <option value="มะลิวัลย์" <?if($_SESSION['rg_branch']=='มะลิวัลย์'){echo "selected";}?>>มะลิวัลย์</option>
                                    <option value="ท่าพระ" <?if($_SESSION['rg_branch']=='ท่าพระ'){echo "selected";}?>>ท่าพระ</option>
                                    <option value="พระยืน" <?if($_SESSION['rg_branch']=='พระยืน'){echo "selected";}?>>พระยืน</option>
                            </select>	
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
                        <label>1.ชื่อผู้ใช้ไฟฟ้า</label>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>คำนำหน้า</label>
                                <select id="cus_first" class="form-control" name="cus_first" <?=$read?>>
									<option style="display: none">--กรุณาเลือก--</option>
                                    <option value="0" <?if($_SESSION['cus_first']=='0'){echo "selected";}?>>นาย</option>
                                    <option value="1" <?if($_SESSION['cus_first']=='1'){echo "selected";}?>>นาง</option>
                                    <option value="2" <?if($_SESSION['cus_first']=='2'){echo "selected";}?>>นางสาว</option>
                                </select>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>ชื่อ-นามสกุล</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_name" type="text" id="cus_name" value="<?=$_SESSION['cus_name']?>"  <?=$read?>>	
                        </div>
                        <div class="col-sm-5 form-group">
                            <label>ประเภทบัตร</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_type" type="text" id="cus_type" value="<?=$_SESSION['cus_type']?>"  <?=$read?>>	
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>รหัสประชาชน </label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" autocomplete=off  name="cus_id" type="text" id="cus_id" value="<?=$_SESSION['cus_id']?>" size="30"  onkeyup="IsNumeric(this.value,this)" maxlength="13" required/>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>หมายเลขประจำตัวผู้เสียภาษีอากร</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_tax" type="text" id="cus_tax" value="<?=$_SESSION['cus_tax']?>" <?=$read?>>	
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>หมายเลขผู้ใช้ไฟฟ้า</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_code" type="text" id="cus_code" value="<?=$_SESSION['cus_code']?>" <?=$read?>>	
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <b>ที่อยู่:</b> <label>รหัสบ้าน</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_homeid" type="text" id="cus_homeid" value="<?=$_SESSION['cus_homeid']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>เลขที่</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_number" type="text" id="cus_number" value="<?=$_SESSION['cus_number']?>"<?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>หมู่บ้าน/อาคาร</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_village" type="text" id="cus_village" value="<?=$_SESSION['cus_village']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ห้อง</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_room" type="text" id="cus_room" value="<?=$_SESSION['cus_room']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ชั้น</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_floor" type="text" id="cus_floor" value="<?=$_SESSION['cus_floor']?>" <?=$read?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตรอก</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_alley" type="text" id="cus_alley" value="<?=$_SESSION['cus_alley']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>ซอย</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_alleyway" type="text" id="cus_alleyway" value="<?=$_SESSION['cus_alleyway']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>ถนน</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_road" type="text" id="cus_road" value="<?=$_SESSION['cus_road']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>หมู่ที่</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_vilno" type="text" id="cus_vilno" value="<?=$_SESSION['cus_vilno']?>" <?=$read?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตำบล</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_district" type="text" id="cus_district" value="<?=$_SESSION['cus_district']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>อำเภอ</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_canton" type="text" id="cus_canton" value="<?=$_SESSION['cus_canton']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>จังหวัด</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_province" type="text" id="cus_province" value="<?=$_SESSION['cus_province']?>"<?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>รหัสไปรษณีย์</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_post" type="text" id="cus_post" value="<?=$_SESSION['cus_post']?>" <?=$read?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>โทรศัพท์</label>
                            <input class="form-control" maxlength="10" placeholder="กรุณากรอกข้อมูล" name="cus_tel" type="text" id="cus_tel" value="<?=$_SESSION['cus_tel']?>"  <?=$read?>>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>โทรสาร/Fax</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_fax" type="text" id="cus_fax" value="<?=$_SESSION['cus_fax']?>"  <?=$read?>>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>E-mail</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="cus_email" type="text" id="cus_email" value="<?=$_SESSION['cus_email']?>" <?=$read?>>
                        </div>
                    </div>
                </div>
                    <center>
                        <input  type="hidden" class="form-control " name="newcus" id="add" value="addcus">
                        <a class="btn btn-info" onclick="location.href='RequestElectricity.php'"><i class="fa fa-arrow-left"> ย้อนกลับ</i></a>
                        <button class="btn  btn-success" name="Submit" type="submit"><i class="fa fa-arrow-right"> ถัดไป</i></button>	
                    </center>
                </div>
            </form> 
        </div>

				
            </div>
        </div>
</body>

</html>
