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
$sql_print="select * from  tb_electricity,tb_user,tb_customer where re_id='".$_GET[re_id]."' and tb_electricity.user_id=tb_user.user_id and tb_electricity.cus_id=tb_customer.cus_id  ";
$result_print=mysql_db_query($dbname,$sql_print);
$array_edit=mysql_fetch_array($result_print);

        $read="disabled";
?>
    <div id="page-wrapper">
        <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">คำร้องขอใช้ไฟฟ้า</h2>
                </div>
            <div class="panel-body">
				<div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>เลขที่คำร้อง</label>
                        <input class="form-control" autocomplete=off  name="re_id" type="text" id="re_id" value="<?=$array_edit[re_id]?>" size="30" readonly/>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>กฟฟ(สาขา).</label>
                            <input class="form-control" autocomplete=off  name="re_id" type="text" id="re_id" value="<?=$array_edit[re_branch]?>" size="30" readonly/>	
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>เจ้าหน้าที่ผู้รับคำร้อง</label>
                            <input class="form-control"  name="user_id" type="text" id="user_id" value="<?=$user[user_name]?> <?=$user[user_last]?>" readonly/>	
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>วัน/เดือน/ปี</label>
                            <input class="form-control"  name="re_date" type="text" id="re_date" value="<?=date("d/m/").(date("Y")+543)?>"  readonly/>	
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
                                    <option value="0" <?if($array_edit['cus_first']=='0'){echo "selected";}?>>นาย</option>
                                    <option value="1" <?if($array_edit['cus_first']=='1'){echo "selected";}?>>นาง</option>
                                    <option value="2" <?if($array_edit['cus_first']=='2'){echo "selected";}?>>นางสาว</option>
                                </select>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>ชื่อ-นามสกุล</label>
                            <input class="form-control"  name="cus_name" type="text" id="cus_name" value="<?=$array_edit['cus_name']?>"  <?=$read?>>	
                        </div>
                        <div class="col-sm-5 form-group">
                            <label>ประเภทบัตร</label>
                            <input class="form-control"  name="cus_type" type="text" id="cus_type" value="<?=$array_edit['cus_type']?>"  <?=$read?>>	
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>รหัสประชาชน </label>
                            <input class="form-control"  autocomplete=off  name="cus_id" type="text" id="cus_id" value="<?=$array_edit['cus_id']?>"<?=$read?>>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>หมายเลขประจำตัวผู้เสียภาษีอากร</label>
                            <input class="form-control"  name="cus_tax" type="text" id="cus_tax" value="<?=$array_edit['cus_tax']?>" <?=$read?>>	
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>หมายเลขผู้ใช้ไฟฟ้า</label>
                            <input class="form-control"  name="cus_code" type="text" id="cus_code" value="<?=$array_edit['cus_code']?>" <?=$read?>>	
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <b>ที่อยู่:</b> <label>รหัสบ้าน</label>
                            <input class="form-control"  name="cus_homeid" type="text" id="cus_homeid" value="<?=$array_edit['cus_homeid']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>เลขที่</label>
                            <input class="form-control"  name="cus_number" type="text" id="cus_number" value="<?=$array_edit['cus_number']?>"<?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>หมู่บ้าน/อาคาร</label>
                            <input class="form-control"  name="cus_village" type="text" id="cus_village" value="<?=$array_edit['cus_village']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ห้อง</label>
                            <input class="form-control"  name="cus_room" type="text" id="cus_room" value="<?=$array_edit['cus_room']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ชั้น</label>
                            <input class="form-control"  name="cus_floor" type="text" id="cus_floor" value="<?=$array_edit['cus_floor']?>" <?=$read?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตรอก</label>
                            <input class="form-control"  name="cus_alley" type="text" id="cus_alley" value="<?=$array_edit['cus_alley']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>ซอย</label>
                            <input class="form-control"  name="cus_alleyway" type="text" id="cus_alleyway" value="<?=$array_edit['cus_alleyway']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>ถนน</label>
                            <input class="form-control"  name="cus_road" type="text" id="cus_road" value="<?=$array_edit['cus_road']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>หมู่ที่</label>
                            <input class="form-control"  name="cus_vilno" type="text" id="cus_vilno" value="<?=$array_edit['cus_vilno']?>" <?=$read?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตำบล</label>
                            <input class="form-control"  name="cus_district" type="text" id="cus_district" value="<?=$array_edit['cus_district']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>อำเภอ</label>
                            <input class="form-control"  name="cus_canton" type="text" id="cus_canton" value="<?=$array_edit['cus_canton']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>จังหวัด</label>
                            <input class="form-control"  name="cus_province" type="text" id="cus_province" value="<?=$array_edit['cus_province']?>"<?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>รหัสไปรษณีย์</label>
                            <input class="form-control"  name="cus_post" type="text" id="cus_post" value="<?=$array_edit['cus_post']?>" <?=$read?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>โทรศัพท์</label>
                            <input class="form-control" maxlength="10"  name="cus_tel" type="text" id="cus_tel" value="<?=$array_edit['cus_tel']?>"  <?=$read?>>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>โทรสาร/Fax</label>
                            <input class="form-control"  name="cus_fax" type="text" id="cus_fax" value="<?=$array_edit['cus_fax']?>"  <?=$read?>>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>E-mail</label>
                            <input class="form-control"  name="cus_email" type="text" id="cus_email" value="<?=$array_edit['cus_email']?>" <?=$read?>>
                        </div>
                    </div>
                </div>
                		<div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>2.สถานที่ขอใช้บริการ</label>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="radio-inline">
                                <label><input name="re_place_type" size="30" type="radio" value="0" id="disable" <? if($array_edit['re_place_type']=="0"){ echo "checked"; }?> <?=$read?>>เอกชน</label>
                            </div>
                            <div class="radio-inline">
                                <label><input name="re_place_type" size="30" type="radio" value="1" id="disable1"<? if($array_edit['re_place_type']=="1"){ echo "checked"; }?> <?=$read?>>ราชการ</label>
                            </div>
                            <div class="radio-inline">
                                <label><input name="re_place_type" size="30" type="radio" value="2" id="enable"<? if($array_edit['re_place_type']=="2"){ echo "checked"; }?> <?=$read?>>อื่นๆ(ระบุ)</label>
                            </div>
   
                        </div>
                        <div class="form-group col-sm-4">
                            <input class="form-control" name="re_place_other" type="text" id="re_place_other" value="<?=$array_edit['re_place_other']?>" <?=$read?>>	
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>ชื่อสถานที่ใช้ไฟฟ้า</label>
                            <textarea class="form-control"  rows="2" id="re_place_name"  name="re_place_name"  <?=$read?>><?=$array_edit['re_place_name']?></textarea>
                        </div>
                    </div>
                                                            
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <b>ที่อยู่:</b> <label>รหัสบ้าน</label>
                            <input class="form-control"  name="re_place_homeid" type="text" id="re_place_homeid" value="<?=$array_edit['re_place_homeid']?>"  <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>เลขที่</label>
                            <input class="form-control"  name="re_place_number" type="text" id="re_place_number" value="<?=$array_edit['re_place_number']?>"  <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>หมู่บ้าน/อาคาร</label>
                            <input class="form-control"  name="re_place_village" type="text" id="re_place_village" value="<?=$array_edit['re_place_village']?>"  <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ห้อง</label>
                            <input class="form-control"  name="re_place_room" type="text" id="re_place_room" value="<?=$array_edit['re_place_room']?>"  <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ชั้น</label>
                            <input class="form-control"  name="re_place_floor" type="text" id="re_place_floor" value="<?=$array_edit['re_place_floor']?>"  <?=$read?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตรอก</label>
                            <input class="form-control"  name="re_place_alley" type="text" id="re_place_alley" value="<?=$array_edit['re_place_alley']?>"  <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>ซอย</label>
                            <input class="form-control"  name="re_place_alleyway" type="text" id="re_place_alleyway" value="<?=$array_edit['re_place_alleyway']?>"  <?=$read?>>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>ถนน</label>
                            <input class="form-control"  name="re_place_road" type="text" id="re_place_road" value="<?=$array_edit['re_place_road']?>"  <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>หมู่ที่</label>
                            <input class="form-control"  name="re_place_vilno" type="text" id="re_place_vilno" value="<?=$array_edit['re_place_vilno']?>"  <?=$read?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตำบล</label>
                            <input class="form-control"  name="re_place_district" type="text" id="re_place_district" value="<?=$array_edit['re_place_district']?>"  <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>อำเภอ</label>
                            <input class="form-control"  name="re_place_canton" type="text" id="re_place_canton" value="<?=$array_edit['re_place_canton']?>"  <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>จังหวัด</label>
                            <input class="form-control"  name="re_place_province" type="text" id="re_place_province"  value="<?=$array_edit['re_place_province']?>"  <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>รหัสไปรษณีย์</label>
                            <input class="form-control"  name="re_place_post" type="text" id="re_place_post" value="<?=$array_edit['re_place_post']?>"  <?=$read?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>โทรศัพท์</label>
                            <input class="form-control"  name="re_place_tel" type="text" id="re_place_tel" value="<?=$array_edit['re_place_tel']?>" onkeyup="IsNumeric(this.value,this)" maxlength="10"  <?=$read?>>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>โทรสาร/Fax</label>
                            <input class="form-control"  name="re_place_fax" type="text" id="re_place_fax" value="<?=$array_edit['re_place_fax']?>" onkeyup="IsNumeric(this.value,this)" maxlength="10"  <?=$read?>>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>E-mail</label>
                            <input class="form-control"  name="re_place_email" type="text" id="re_place_email" value="<?=$array_edit['re_place_email']?>"  <?=$read?>>
                        </div>
                        <div class="form-group col-sm-12">
                            <label>ประเภทกิจการ</label>
                            <textarea class="form-control"  rows="2" id="re_place_service"  name="re_place_service"  <?=$read?>><?=$array_edit['re_place_service']?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>3.สถานที่ติดต่อ/ที่อยู่ในการจัดส่งเอกสาร</label>
                            <textarea class="form-control"  rows="2" id="re_contact_place"  name="re_contact_place" <?=$read?>><?=$array_edit['re_contact_place']?></textarea>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <b>ที่อยู่:</b> <label>รหัสบ้าน</label>
                            <input class="form-control"  name="re_contact_homeid" type="text" id="re_contact_homeid" value="<?=$array_edit['re_contact_homeid']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>เลขที่</label>
                            <input class="form-control"  name="re_contact_number" type="text" id="re_contact_number" value="<?=$array_edit['re_contact_number']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>หมู่บ้าน/อาคาร</label>
                            <input class="form-control"  name="re_contact_village" type="text" id="re_contact_village" value="<?=$array_edit['re_contact_village']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ห้อง</label>
                            <input class="form-control"  name="re_contact_room" type="text" id="re_contact_room" value="<?=$array_edit['re_contact_room']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ชั้น</label>
                            <input class="form-control"  name="re_contact_floor" type="text" id="re_contact_floor" value="<?=$array_edit['re_contact_floor']?>" <?=$read?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตรอก</label>
                            <input class="form-control"  name="re_contact_alley" type="text" id="re_contact_alley" value="<?=$array_edit['re_contact_alley']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>ซอย</label>
                            <input class="form-control"  name="re_contact_alleyway" type="text" id="re_contact_alleyway" value="<?=$array_edit['re_contact_alleyway']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>ถนน</label>
                            <input class="form-control"  name="re_contact_road" type="text" id="re_contact_road" value="<?=$array_edit['re_contact_road']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>หมู่ที่</label>
                            <input class="form-control"  name="re_contact_villno" type="text" id="re_contact_vilno" value="<?=$array_edit['re_contact_villno']?>" <?=$read?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตำบล</label>
                            <input class="form-control"  name="re_contact_district" type="text" id="re_contact_district" value="<?=$array_edit['re_contact_district']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>อำเภอ</label>
                            <input class="form-control"  name="re_contact_canton" type="text" id="re_contact_canton" value="<?=$array_edit['re_contact_canton']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>จังหวัด</label>
                            <input class="form-control"  name="re_contact_province" type="text" id="re_contact_province" value="<?=$array_edit['re_contact_province']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>รหัสไปรษณีย์</label>
                            <input class="form-control"  name="re_contact_post" type="text" id="re_contact_post" maxlength="5" value="<?=$array_edit['re_contact_post']?>" <?=$read?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>โทรศัพท์</label>
                            <input class="form-control"  name="re_contact_tel" type="text" id="re_contact_tel" onkeyup="IsNumeric(this.value,this)" value="<?=$array_edit['re_contact_tel']?>" maxlength="10" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>โทรสาร/Fax</label>
                            <input class="form-control"  name="re_contact_fax" type="text" id="re_contact_fax"  onkeyup="IsNumeric(this.value,this)" value="<?=$array_edit['re_contact_fax']?>" maxlength="10" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>E-mail</label>
                            <input class="form-control"  name="re_contact_email" type="text" id="re_contact_email" value="<?=$array_edit['re_contact_email']?>" <?=$read?>>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>4.มีความประสงค์</label>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="0" id="re_want_type0" <?php if($array_edit['re_want_type']=="0"){ echo "checked"; }?> <?=$read?>>ขอติดตั้งมิเตอร์ใหม่</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="1" id="re_want_type1" <?php if($array_edit['re_want_type']=="1"){ echo "checked"; }?> <?=$read?>>ขอตัดฝากมิเตอร์โดยไม่ใช้ไฟฟ้า</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="2" id="re_want_type2" <?php if($array_edit['re_want_type']=="2"){ echo "checked"; }?> <?=$read?>>ขอต่อกลับการใช้ไฟฟ้า</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="3" id="re_want_type3" <?php if($array_edit['re_want_type']=="3"){ echo "checked"; }?> <?=$read?>>ขอเพื่มขนาดมิเตอร์/อุปกรณ์ประกอบ</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="4" id="re_want_type4" <?php if($array_edit['re_want_type']=="4"){ echo "checked"; }?> <?=$read?>>ขอเปลี่ยนประเภทมิเตอร์</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="5" id="re_want_type5" <?php if($array_edit['re_want_type']=="5"){ echo "checked"; }?> <?=$read?>>ขอหยุดซ่อมแซมเครื่องจักรประจำปี</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="6" id="re_want_type6" <?php if($array_edit['re_want_type']=="6"){ echo "checked"; }?> <?=$read?>>ขอใช้ไฟฟ้าชั่วคราวแบบเหมาจ่าย</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="7" id="re_want_type7" <?php if($array_edit['re_want_type']=="7"){ echo "checked"; }?> <?=$read?>>ขอติดตั้งไฟฟ้าชั่วคราว</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="8" id="re_want_type8" <?php if($array_edit['re_want_type']=="8"){ echo "checked"; }?> <?=$read?>>ขอตัดฝากมิเตอร์ใช้เพื่อแสงสว่างไม่ลด CT</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="9" id="re_want_type9" <?php if($array_edit['re_want_type']=="9"){ echo "checked"; }?> <?=$read?>>ขอยกเลิกเลิกการใช้ไฟฟ้า</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="10" id="re_want_type10" <?php if($array_edit['re_want_type']=="10"){ echo "checked"; }?> <?=$read?>>ชอลดขนาดมิเตอร์/อุปกรณ์ประกอบ</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="11" id="re_want_type11" <?php if($array_edit['re_want_type']=="11"){ echo "checked"; }?> <?=$read?>>ขอใช้ไฟฟ้าสาธารณะ</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="12" id="re_want_type12" <?php if($array_edit['re_want_type']=="12"){ echo "checked"; }?> <?=$read?>>ขอตัดมิเตอร์ใช้เพื่อแสงสว่างลด CT</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="13" id="re_want_type13" <?php if($array_edit['re_want_type']=="13"){ echo "checked"; }?> <?=$read?>>ขอย้ายจุดติดตั้งมิเตอร์/อุปกรณ์ประกอบ</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="14" id="re_want_type14" <?php if($array_edit['re_want_type']=="14"){ echo "checked"; }?> <?=$read?>>ขอเปลี่ยนมิเตอร์กรณีชำรุด</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="15" id="re_want_type15" <?php if($array_edit['re_want_type']=="15"){ echo "checked"; }?> <?=$read?>>ขอใช้ไฟฟ้าตู้โทรศัพท์ต่อตรง</label>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" id="re_want_type16" value="16"  <?php if($array_edit['re_want_type']=="16"){ echo "checked"; }?> <?=$read?>>อื่นๆ ระบุ:</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-10">
                            <input class="form-control"  name="re_want_other" type="text" id="re_want_other" value="<?=$array_edit['re_want_other']?>" <?=$read?>>	
                        </div> 
                    </div>
                        <div class="form-group col-sm-12">
                            <label>รายละเอียดเพื่มเติม</label>
                            <textarea class="form-control"  rows="2" id="re_detail"  name="re_detail" <?=$read ?>><?=$array_edit['re_detail']?></textarea>
                        </div> 
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>5.ประเภทการใช้ไฟฟ้า</label>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <div class="radio">
                                <label><input name="re_use_type" size="30" type="radio" value="0" id="re_use_type0"  <?php if($array_edit['re_use_type']=="0"){ echo "checked"; }?> <?=$read?>>บ้านที่อยู่อาศัย</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_use_type" size="30" type="radio" value="1" id="re_use_type1" <?php if($array_edit['re_use_type']=="1"){ echo "checked"; }?> <?=$read?>>กิจการเฉพาะอย่าง</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <div class="radio">
                                <label><input name="re_use_type" size="30" type="radio" value="2" id="re_use_type2" <?php if($array_edit['re_use_type']=="2"){ echo "checked"; }?> <?=$read?>>กิจการขนาดเล็ก</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_use_type" size="30" type="radio" value="3" id="re_use_type3" <?php if($array_edit['re_use_type']=="3"){ echo "checked"; }?> <?=$read?>>ราชการ/องค์กรไม่แสวงหากำไร CT</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <div class="radio">
                                <label><input name="re_use_type" size="30" type="radio" value="4" id="re_use_type4" <?php if($array_edit['re_use_type']=="4"){ echo "checked"; }?> <?=$read?>>กิจการขนาดกลาง</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_use_type" size="30" type="radio" value="5" id="re_use_type5" <?php if($array_edit['re_use_type']=="5"){ echo "checked"; }?> <?=$read?>>สูบน้ำเพื่อการเกษตร CT</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <div class="radio">
                                <label><input name="re_use_type" size="30" type="radio" value="6" id="re_use_type6" <?php if($array_edit['re_use_type']=="6"){ echo "checked"; }?> <?=$read?>>กิจการขนาดใหญ่</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_use_type" size="30" type="radio" value="7" id="re_use_type7" <?php if($array_edit['re_use_type']=="7"){ echo "checked"; }?> <?=$read?>>ไฟฟ้าชั่วคราว</label>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <div class="radio">
                                <label><input name="re_use_type" size="30" type="radio" id="re_use_type8" value="8" <?php if($array_edit['re_use_type']=="8"){ echo "checked"; }?> <?=$read?>>อื่นๆ ระบุ:</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-10">
                            <input class="form-control"  name="re_use_other" type="text" id="re_use_other" value="<?=$array_edit['re_use_other']?>" <?=$read?>>	
                        </div> 
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>6.กำหนดการใช้ไฟฟ้า</label>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="form-group col-sm-6">
                                <div class="form-group ">
                                    <input type="date" class="form-control"  name="re_dateset" value="<?=$array_edit['re_dateset']?>" <?=$read?>>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-5 form-group">
                            <label>7.ผู้ขอใช้ไฟฟ้ามีความประสงค์ที่จะชำระเงินค่าไฟฟ้าประจำเดือนด้วย</label>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="radio-inline">
                                <label><input name="re_keep_type" size="30" type="radio" value="0" id="re_keep_type" <?php if($array_edit['re_keep_type']=="0"){ echo "checked"; }?> <?=$read?>>เงินสด</label>
                            </div>
                            <div class="radio-inline">
                                <label><input name="re_keep_type" size="30" type="radio" value="1" id="re_keep_type2" <?php if($array_edit['re_keep_type']=="1"){ echo "checked"; }?> <?=$read?>>หักจากบัญชีธนาคาร</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>ทั้งนี้ กฟภ. สามารถเรียกเก็บเงินค่ากระแสไฟฟ้าดังกล่าวได้จาก</label>
                            <textarea class="form-control"  rows="1" name="re_keep_name" <?=$read?> ><?=$array_edit['re_keep_name']?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <b>ที่อยู่:</b> <label>รหัสบ้าน</label>
                            <input class="form-control"  name="re_keep_homeid" type="text" id="re_keep_homeid" value="<?=$array_edit['re_keep_homeid']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>เลขที่</label>
                            <input class="form-control"  name="re_keep_number" type="text" id="re_keep_number" value="<?=$array_edit['re_keep_number']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>หมู่บ้าน/อาคาร</label>
                            <input class="form-control"  name="re_keep_village" type="text" id="re_keep_village" value="<?=$array_edit['re_keep_village']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ห้อง</label>
                            <input class="form-control"  name="re_keep_room" type="text" id="re_keep_room" value="<?=$array_edit['re_keep_room']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ชั้น</label>
                            <input class="form-control"  name="re_keep_floor" type="text" id="re_keep_floor" value="<?=$array_edit['re_keep_floor']?>" <?=$read?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตรอก</label>
                            <input class="form-control"  name="re_keep_alley" type="text" id="re_keep_alley" value="<?=$array_edit['re_keep_alley']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>ซอย</label>
                            <input class="form-control"  name="re_keep_alleyway" type="text" id="re_keep_alleyway" value="<?=$array_edit['re_keep_alleyway']?>"  <?=$read?>>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>ถนน</label>
                            <input class="form-control"  name="re_keep_road" type="text" id="re_keep_road" value="<?=$array_edit['re_keep_road']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>หมู่ที่</label>
                            <input class="form-control"  name="re_keep_villno" type="text" id="re_keep_vilno" value="<?=$array_edit['re_keep_villno']?>" <?=$read?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตำบล</label>
                            <input class="form-control"  name="re_keep_district" type="text" id="re_keep_district" value="<?=$array_edit['re_keep_district']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>อำเภอ</label>
                            <input class="form-control"  name="re_keep_canton" type="text" id="re_keep_canton" value="<?=$array_edit['re_keep_canton']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>จังหวัด</label>
                            <input class="form-control"  name="re_keep_province" type="text" id="re_keep_province" value="<?=$array_edit['re_keep_province']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>รหัสไปรษณีย์</label>
                            <input class="form-control"  name="re_keep_post" type="text" id="re_keep_post" value="<?=$array_edit['re_keep_post']?>" <?=$read?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>โทรศัพท์</label>
                            <input class="form-control"  name="re_keep_tel" type="text" id="re_keep_tel" value="<?=$array_edit['re_keep_tel']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>โทรสาร/Fax</label>
                            <input class="form-control"  name="re_keep_fax" type="text" id="re_keep_fax"  value="<?=$array_edit['re_keep_fax']?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>E-mail</label>
                            <input class="form-control"  name="re_keep_email" type="text" id="re_keep_email" value="<?=$array_edit['re_keep_email']?>" <?=$read?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>แผนที่สังเขป</label>
                            <a href="<?=$array_edit['re_picture']?>" target="_blank" class="link_page" title="แสดงภาพ"><img  class="img-responsive" src="<?=$array_edit['re_picture']?>" ></a>
                        </div>
                    </div>
                </div>
                </div>
                    <center>
                        <a class="btn btn-info" onclick="window.history.back()">ย้อนกลับ</a>
                        <a class="btn btn-default" href="RequestElectricity_print.php?re_id=<?= $array_edit[re_id] ?>" target="_blank">พิมพ์</a>	
                    </center>
                </div>
        </div>


            </div>
        </div>
</body>

</html>
