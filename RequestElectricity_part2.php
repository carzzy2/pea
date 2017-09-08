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
        <script type="text/javascript">
$(document).ready(function() {
$("#checkbox-place").click(function(){
    if ($(this).is(':checked')) {
    $("#re_place_homeid").val("<?= $_SESSION[cus_homeid] ?>");
    $("#re_place_homeid").attr('readonly', true);
    $("#re_place_number").val("<?= $_SESSION[cus_number] ?>");
    $("#re_place_number").attr('readonly', true);
    $("#re_place_village").val("<?= $_SESSION[cus_village] ?>");
    $("#re_place_village").attr('readonly', true);
    $("#re_place_room").val("<?= $_SESSION[cus_room] ?>");
    $("#re_place_room").attr('readonly', true);
    $("#re_place_floor").val("<?= $_SESSION[cus_floor] ?>");
    $("#re_place_floor").attr('readonly', true);
    $("#re_place_alley").val("<?= $_SESSION[cus_alley] ?>");
    $("#re_place_alley").attr('readonly', true);
    $("#re_place_alleyway").val("<?= $_SESSION[cus_alleyway] ?>");
    $("#re_place_alleyway").attr('readonly', true);
    $("#re_place_road").val("<?= $_SESSION[cus_road] ?>");
    $("#re_place_road").attr('readonly', true);
    $("#re_place_vilno").val("<?= $_SESSION[cus_vilno] ?>");
    $("#re_place_vilno").attr('readonly', true);
    $("#re_place_district").val("<?= $_SESSION[cus_district] ?>");
    $("#re_place_district").attr('readonly', true);
    $("#re_place_canton").val("<?= $_SESSION[cus_canton] ?>");
    $("#re_place_canton").attr('readonly', true);
    $("#re_place_province").val("<?= $_SESSION[cus_province] ?>");
    $("#re_place_province").attr('readonly', true);
    $("#re_place_post").val("<?= $_SESSION[cus_post] ?>");
    $("#re_place_post").attr('readonly', true);
    $("#re_place_tel").val("<?= $_SESSION[cus_tel] ?>");
    $("#re_place_tel").attr('readonly', true);
    $("#re_place_fax").val("<?= $_SESSION[cus_fax] ?>");
    $("#re_place_fax").attr('readonly', true);
    $("#re_place_road").val("<?= $_SESSION[cus_road] ?>");
    $("#re_place_road").attr('readonly', true);
    $("#re_place_email").val("<?= $_SESSION[cus_email] ?>");
    $("#re_place_email").attr('readonly', true);
  }else{
     $("#re_place_homeid").val("");
    $("#re_place_homeid").attr('readonly', false);
    $("#re_place_number").val("");
    $("#re_place_number").attr('readonly', false);
    $("#re_place_village").val("");
    $("#re_place_village").attr('readonly', false);
    $("#re_place_room").val("");
    $("#re_place_room").attr('readonly', false);
    $("#re_place_floor").val("");
    $("#re_place_floor").attr('readonly', false);
    $("#re_place_alley").val("");
    $("#re_place_alley").attr('readonly', false);
    $("#re_place_alleyway").val("");
    $("#re_place_alleyway").attr('readonly', false);
    $("#re_place_road").val("");
    $("#re_place_road").attr('readonly', false);
    $("#re_place_vilno").val("");
    $("#re_place_vilno").attr('readonly', false);
    $("#re_place_district").val("");
    $("#re_place_district").attr('readonly', false);
    $("#re_place_canton").val("");
    $("#re_place_canton").attr('readonly', false);
    $("#re_place_province").val("");
    $("#re_place_province").attr('readonly', false);
    $("#re_place_post").val("");
    $("#re_place_post").attr('readonly', false);
    $("#re_place_tel").val("");
    $("#re_place_tel").attr('readonly', false);
    $("#re_place_fax").val("");
    $("#re_place_fax").attr('readonly', false);
    $("#re_place_road").val("");
    $("#re_place_road").attr('readonly', false);
    $("#re_place_email").val("");
    $("#re_place_email").attr('readonly', false); 
  }
}); 
});
</script>
    <div id="page-wrapper">
        <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">คำร้องขอใช้ไฟฟ้า</h2>
                </div>
            <div class="panel-body">

            <form method="post" action="RequestElectricity_Ses.php?mode=RequestElectricity_part2">
                <?php
                $sql_find = "select cus_id from tb_customer where cus_id='" . $_POST[cus_id] . "'";
                $result_find = mysql_db_query($dbname, $sql_find);
                if (mysql_num_rows($result_find) > 0) {
                    echo "<script>alert('รหัสประชาชนที่กรอก:" . $_POST[cus_id] . "มีอยู่แล้วในระบบ');</script>";
                    echo "<META http-equiv='refresh' Content='0; URL=RequestElectricity.php'> ";
                    exit();
                }
                $new_id = mysql_result(mysql_query("Select Max(substr(re_id,-4))+1 as MaxID from tb_electricity"), 0, "MaxID");
                if ($new_id == '') {
                    $re_id = "120000000001";
                } else {
                    $re_id = "12" . sprintf("%010d", $new_id);
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
                            <?php  if($_SESSION['rg_branch']!=""){ ?>
                            <input class="form-control"  name="rg_branch" type="text" id="rg_branch" value="<?=$_SESSION['rg_branch']?>" size="30" readonly/>
                            <?php }else{ ?>
                            <select class="form-control" name="rg_branch" id="rg_branch" >
                                    <option style="display: none">--กรุณาเลือก--</option>
                                    <option value="มะลิวัลย์" >มะลิวัลย์</option>
                                    <option value="ท่าพระ" >ท่าพระ</option>
                                    <option value="พระยืน" >พระยืน</option>
                            </select>
                            <?php } ?>
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
                        <div class="col-sm-3 form-group">
                            <label>2.สถานที่ขอใช้บริการ</label>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="radio-inline">
                                <label><input name="re_place_type" size="30" type="radio" value="0" id="disable" <? if($_SESSION['re_place_type']=="0"){ echo "checked"; }?>>เอกชน</label>
                            </div>
                            <div class="radio-inline">
                                <label><input name="re_place_type" size="30" type="radio" value="1" id="disable1"<? if($_SESSION['re_place_type']=="1"){ echo "checked"; }?>>ราชการ</label>
                            </div>
                            <div class="radio-inline">
                                <label><input name="re_place_type" size="30" type="radio" value="2" id="enable"<? if($_SESSION['re_place_type']=="2"){ echo "checked"; }?>>อื่นๆ(ระบุ)</label>
                            </div>
   
                        </div>
                        <div class="form-group col-sm-4">
                            <input class="form-control" name="re_place_other" type="text" id="re_place_other" value="<?=$_SESSION['re_place_other']?>">	
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>ชื่อสถานที่ใช้ไฟฟ้า</label>
                            <textarea class="form-control"  rows="2" id="re_place_name" placeholder="กรุณากรอกข้อมูล" name="re_place_name"><?=$_SESSION['re_place_name']?></textarea>
                        </div>
                        <div class="form-group col-sm-12">
                            <input type="checkbox" id="checkbox-place"><b> ใช้ที่อยู่เดียวกับที่อยู่ผู้ใช้ไฟฟ้า</b>
                        </div>
                    </div>
                                                            
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <b>ที่อยู่:</b> <label>รหัสบ้าน</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_place_homeid" type="text" id="re_place_homeid" value="<?=$_SESSION['re_place_homeid']?>" required/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>เลขที่</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_place_number" type="text" id="re_place_number" value="<?=$_SESSION['re_place_number']?>" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>หมู่บ้าน/อาคาร</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_place_village" type="text" id="re_place_village" value="<?=$_SESSION['re_place_village']?>" required/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ห้อง</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_place_room" type="text" id="re_place_room" value="<?=$_SESSION['re_place_room']?>" required/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ชั้น</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_place_floor" type="text" id="re_place_floor" value="<?=$_SESSION['re_place_floor']?>" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตรอก</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_place_alley" type="text" id="re_place_alley" value="<?=$_SESSION['re_place_alley']?>" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>ซอย</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_place_alleyway" type="text" id="re_place_alleyway" value="<?=$_SESSION['re_place_alleyway']?>" required/>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>ถนน</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_place_road" type="text" id="re_place_road" value="<?=$_SESSION['re_place_road']?>" required/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>หมู่ที่</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_place_vilno" type="text" id="re_place_vilno" value="<?=$_SESSION['re_place_vilno']?>" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตำบล</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_place_district" type="text" id="re_place_district" value="<?=$_SESSION['re_place_district']?>" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>อำเภอ</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_place_canton" type="text" id="re_place_canton" value="<?=$_SESSION['re_place_canton']?>" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>จังหวัด</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_place_province" type="text" id="re_place_province"  value="<?=$_SESSION['re_place_province']?>" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>รหัสไปรษณีย์</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_place_post" type="text" id="re_place_post" value="<?=$_SESSION['re_place_post']?>" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>โทรศัพท์</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_place_tel" type="text" id="re_place_tel" value="<?=$_SESSION['re_place_tel']?>" onkeyup="IsNumeric(this.value,this)" maxlength="10" required/>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>โทรสาร/Fax</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_place_fax" type="text" id="re_place_fax" value="<?=$_SESSION['re_place_fax']?>" onkeyup="IsNumeric(this.value,this)" maxlength="10" required/>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>E-mail</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_place_email" type="text" id="re_place_email" value="<?=$_SESSION['re_place_email']?>" required/>
                        </div>
                        <div class="form-group col-sm-12">
                            <label>ประเภทกิจการ</label>
                            <textarea class="form-control"  rows="2" id="re_place_service" placeholder="กรุณากรอกข้อมูล" name="re_place_service"><?=$_SESSION['re_place_service']?></textarea>
                        </div>
                    </div>
                </div>
<script type="text/javascript">
$(document).ready(function() {
    
$("#re_place_other").attr('disabled', true);
$("#disable").attr('checked', true);
$("#disable").click(function(){
    $("#re_place_other").attr('disabled', true);
});
$("#enable").click(function(){
    $("#re_place_other").attr('disabled', false);
});
$("#disable1").click(function(){
    $("#re_place_other").attr('disabled', true);
});

});
</script>
                    <center>
                        <input  type="hidden" class="form-control " name="newcus" id="add" value="addcus">
                        <a class="btn btn-info" onclick="javascript:history.back(1)"><i class="fa fa-arrow-left"> ย้อนกลับ</i></a>
                        <button class="btn  btn-success" name="Submit" type="submit"><i class="fa fa-arrow-right"> ถัดไป</i></button>	
                    </center>
                </div>
            </form> 
        </div>

				
            </div>
        </div>
</body>

</html>
