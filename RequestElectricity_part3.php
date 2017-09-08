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
    $("#re_contact_homeid").val("<?= $_SESSION[cus_homeid] ?>");
    $("#re_contact_homeid").attr('readonly', true);
    $("#re_contact_number").val("<?= $_SESSION[cus_number] ?>");
    $("#re_contact_number").attr('readonly', true);
    $("#re_contact_village").val("<?= $_SESSION[cus_village] ?>");
    $("#re_contact_village").attr('readonly', true);
    $("#re_contact_room").val("<?= $_SESSION[cus_room] ?>");
    $("#re_contact_room").attr('readonly', true);
    $("#re_contact_floor").val("<?= $_SESSION[cus_floor] ?>");
    $("#re_contact_floor").attr('readonly', true);
    $("#re_contact_alley").val("<?= $_SESSION[cus_alley] ?>");
    $("#re_contact_alley").attr('readonly', true);
    $("#re_contact_alleyway").val("<?= $_SESSION[cus_alleyway] ?>");
    $("#re_contact_alleyway").attr('readonly', true);
    $("#re_contact_road").val("<?= $_SESSION[cus_road] ?>");
    $("#re_contact_road").attr('readonly', true);
    $("#re_contact_vilno").val("<?= $_SESSION[cus_vilno] ?>");
    $("#re_contact_vilno").attr('readonly', true);
    $("#re_contact_district").val("<?= $_SESSION[cus_district] ?>");
    $("#re_contact_district").attr('readonly', true);
    $("#re_contact_canton").val("<?= $_SESSION[cus_canton] ?>");
    $("#re_contact_canton").attr('readonly', true);
    $("#re_contact_province").val("<?= $_SESSION[cus_province] ?>");
    $("#re_contact_province").attr('readonly', true);
    $("#re_contact_post").val("<?= $_SESSION[cus_post] ?>");
    $("#re_contact_post").attr('readonly', true);
    $("#re_contact_tel").val("<?= $_SESSION[cus_tel] ?>");
    $("#re_contact_tel").attr('readonly', true);
    $("#re_contact_fax").val("<?= $_SESSION[cus_fax] ?>");
    $("#re_contact_fax").attr('readonly', true);
    $("#re_contact_road").val("<?= $_SESSION[cus_road] ?>");
    $("#re_contact_road").attr('readonly', true);
    $("#re_contact_email").val("<?= $_SESSION[cus_email] ?>");
    $("#re_contact_email").attr('readonly', true);
  }else{
     $("#re_contact_homeid").val("");
    $("#re_contact_homeid").attr('readonly', false);
    $("#re_contact_number").val("");
    $("#re_contact_number").attr('readonly', false);
    $("#re_contact_village").val("");
    $("#re_contact_village").attr('readonly', false);
    $("#re_contact_room").val("");
    $("#re_contact_room").attr('readonly', false);
    $("#re_contact_floor").val("");
    $("#re_contact_floor").attr('readonly', false);
    $("#re_contact_alley").val("");
    $("#re_contact_alley").attr('readonly', false);
    $("#re_contact_alleyway").val("");
    $("#re_contact_alleyway").attr('readonly', false);
    $("#re_contact_road").val("");
    $("#re_contact_road").attr('readonly', false);
    $("#re_contact_vilno").val("");
    $("#re_contact_vilno").attr('readonly', false);
    $("#re_contact_district").val("");
    $("#re_contact_district").attr('readonly', false);
    $("#re_contact_canton").val("");
    $("#re_contact_canton").attr('readonly', false);
    $("#re_contact_province").val("");
    $("#re_contact_province").attr('readonly', false);
    $("#re_contact_post").val("");
    $("#re_contact_post").attr('readonly', false);
    $("#re_contact_tel").val("");
    $("#re_contact_tel").attr('readonly', false);
    $("#re_contact_fax").val("");
    $("#re_contact_fax").attr('readonly', false);
    $("#re_contact_road").val("");
    $("#re_contact_road").attr('readonly', false);
    $("#re_contact_email").val("");
    $("#re_contact_email").attr('readonly', false); 
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

            <form method="post" action="RequestElectricity_Ses.php?mode=RequestElectricity_part3">
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
                            <label>3.สถานที่ติดต่อ/ที่อยู่ในการจัดส่งเอกสาร</label>
                            <textarea class="form-control"  rows="2" id="re_contact_place" placeholder="กรุณากรอกข้อมูล" name="re_contact_place"><?=$_SESSION['re_contact_place']?></textarea>
                        </div>
                        <div class="form-group col-sm-12">
                            <input type="checkbox" id="checkbox-place"><b> ใช้ที่อยู่เดียวกับที่อยู่ผู้ใช้ไฟฟ้า</b>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <b>ที่อยู่:</b> <label>รหัสบ้าน</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_contact_homeid" type="text" id="re_contact_homeid" value="<?=$_SESSION['re_contact_homeid']?>" required/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>เลขที่</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_contact_number" type="text" id="re_contact_number" value="<?=$_SESSION['re_contact_number']?>" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>หมู่บ้าน/อาคาร</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_contact_village" type="text" id="re_contact_village" value="<?=$_SESSION['re_contact_village']?>" required/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ห้อง</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_contact_room" type="text" id="re_contact_room" value="<?=$_SESSION['re_contact_room']?>" required/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ชั้น</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_contact_floor" type="text" id="re_contact_floor" value="<?=$_SESSION['re_contact_floor']?>" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตรอก</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_contact_alley" type="text" id="re_contact_alley" value="<?=$_SESSION['re_contact_alley']?>" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>ซอย</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_contact_alleyway" type="text" id="re_contact_alleyway" value="<?=$_SESSION['re_contact_alleyway']?>" required/>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>ถนน</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_contact_road" type="text" id="re_contact_road" value="<?=$_SESSION['re_contact_road']?>" required/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>หมู่ที่</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_contact_villno" type="text" id="re_contact_vilno" value="<?=$_SESSION['re_contact_villno']?>" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตำบล</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_contact_district" type="text" id="re_contact_district" value="<?=$_SESSION['re_contact_district']?>" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>อำเภอ</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_contact_canton" type="text" id="re_contact_canton" value="<?=$_SESSION['re_contact_canton']?>" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>จังหวัด</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_contact_province" type="text" id="re_contact_province" value="<?=$_SESSION['re_contact_province']?>" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>รหัสไปรษณีย์</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_contact_post" type="text" id="re_contact_post" maxlength="5" value="<?=$_SESSION['re_contact_post']?>" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>โทรศัพท์</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_contact_tel" type="text" id="re_contact_tel" onkeyup="IsNumeric(this.value,this)" value="<?=$_SESSION['re_contact_tel']?>" maxlength="10" required/>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>โทรสาร/Fax</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_contact_fax" type="text" id="re_contact_fax"  onkeyup="IsNumeric(this.value,this)" value="<?=$_SESSION['re_contact_fax']?>" maxlength="10" required/>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>E-mail</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_contact_email" type="text" id="re_contact_email" value="<?=$_SESSION['re_contact_email']?>" required/>
                        </div>
                    </div>
                </div>
                    <center>
                        <input  type="hidden" class="form-control " name="newcus" id="add" value="addcus">
                        <a class="btn btn-info" onclick="location.href='RequestElectricity_part2.php'"><i class="fa fa-arrow-left"> ย้อนกลับ</i></a>
                        <button class="btn  btn-success" name="Submit" type="submit"><i class="fa fa-arrow-right"> ถัดไป</i></button>	
                    </center>
                </div>
            </form> 
        </div>

				
            </div>
        </div>
</body>

</html>
