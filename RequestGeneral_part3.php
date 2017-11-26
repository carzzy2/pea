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
if(!isset($_GET[back])){
   if($_POST[add]=="oldcus"){
     $_SESSION[ss_rg_branch]=$_POST[rg_branch];
     $_SESSION[ss_add]="oldcus";
 }else{
     $_SESSION[ss_add]="newcus";
 }
    $_SESSION[ss_rg_place_type]=$_POST[rg_place_type];
    $_SESSION[ss_rg_place_other]=$_POST[rg_place_other];
    $_SESSION[ss_rg_place_name]=$_POST[rg_place_name];

    $_SESSION[ss_rg_place_homeid]=$_POST[rg_place_homeid];
    $_SESSION[ss_rg_place_number]=$_POST[rg_place_number];
    $_SESSION[ss_rg_place_village]=$_POST[rg_place_village];
    $_SESSION[ss_rg_place_room]=$_POST[rg_place_room];
    $_SESSION[ss_rg_place_floor]=$_POST[rg_place_floor];
    $_SESSION[ss_rg_place_alley]=$_POST[rg_place_alley];
    $_SESSION[ss_rg_place_alleyway]=$_POST[rg_place_alleyway];
    $_SESSION[ss_rg_place_road]=$_POST[rg_place_road];
    $_SESSION[ss_rg_place_vilno]=$_POST[rg_place_villno];
    $_SESSION[ss_rg_place_district]=$_POST[rg_place_district];
    $_SESSION[ss_rg_place_canton]=$_POST[rg_place_canton];
    $_SESSION[ss_rg_place_province]=$_POST[rg_place_province];
    $_SESSION[ss_rg_place_post]=$_POST[rg_place_post];
    $_SESSION[ss_rg_place_tel]=$_POST[rg_place_tel];
    $_SESSION[ss_rg_place_fax]=$_POST[rg_place_fax];
    $_SESSION[ss_rg_place_road]=$_POST[rg_place_road];
    $_SESSION[ss_rg_place_email]=$_POST[rg_place_email];
    
    $_SESSION[ss_rg_place_service]=$_POST[rg_place_service];  
}

?>
<script type="text/javascript">
$(document).ready(function() {
$("#checkbox-place").click(function(){
    if ($(this).is(':checked')) {
    $("#rg_contact_homeid").val("<?= $_SESSION[ss_cus_homeid] ?>");
    $("#rg_contact_homeid").attr('readonly', true);
    $("#rg_contact_number").val("<?= $_SESSION[ss_cus_number] ?>");
    $("#rg_contact_number").attr('readonly', true);
    $("#rg_contact_village").val("<?= $_SESSION[ss_cus_village] ?>");
    $("#rg_contact_village").attr('readonly', true);
    $("#rg_contact_room").val("<?= $_SESSION[ss_cus_room] ?>");
    $("#rg_contact_room").attr('readonly', true);
    $("#rg_contact_floor").val("<?= $_SESSION[ss_cus_floor] ?>");
    $("#rg_contact_floor").attr('readonly', true);
    $("#rg_contact_alley").val("<?= $_SESSION[ss_cus_alley] ?>");
    $("#rg_contact_alley").attr('readonly', true);
    $("#rg_contact_alleyway").val("<?= $_SESSION[ss_cus_alleyway] ?>");
    $("#rg_contact_alleyway").attr('readonly', true);
    $("#rg_contact_road").val("<?= $_SESSION[ss_cus_road] ?>");
    $("#rg_contact_road").attr('readonly', true);
    $("#rg_contact_vilno").val("<?= $_SESSION[ss_cus_vilno] ?>");
    $("#rg_contact_vilno").attr('readonly', true);
    $("#rg_contact_district").val("<?= $_SESSION[ss_cus_district] ?>");
    $("#rg_contact_district").attr('readonly', true);
    $("#rg_contact_canton").val("<?= $_SESSION[ss_cus_canton] ?>");
    $("#rg_contact_canton").attr('readonly', true);
    $("#rg_contact_province").val("<?= $_SESSION[ss_cus_province] ?>");
    $("#rg_contact_province").attr('readonly', true);
    $("#rg_contact_post").val("<?= $_SESSION[ss_cus_post] ?>");
    $("#rg_contact_post").attr('readonly', true);
    $("#rg_contact_tel").val("<?= $_SESSION[ss_cus_tel] ?>");
    $("#rg_contact_tel").attr('readonly', true);
    $("#rg_contact_fax").val("<?= $_SESSION[ss_cus_fax] ?>");
    $("#rg_contact_fax").attr('readonly', true);
    $("#rg_contact_road").val("<?= $_SESSION[ss_cus_road] ?>");
    $("#rg_contact_road").attr('readonly', true);
    $("#rg_contact_email").val("<?= $_SESSION[ss_cus_email] ?>");
    $("#rg_contact_email").attr('readonly', true);
  }else{
     $("#rg_contact_homeid").val("");
    $("#rg_contact_homeid").attr('readonly', false);
    $("#rg_contact_number").val("");
    $("#rg_contact_number").attr('readonly', false);
    $("#rg_contact_village").val("");
    $("#rg_contact_village").attr('readonly', false);
    $("#rg_contact_room").val("");
    $("#rg_contact_room").attr('readonly', false);
    $("#rg_contact_floor").val("");
    $("#rg_contact_floor").attr('readonly', false);
    $("#rg_contact_alley").val("");
    $("#rg_contact_alley").attr('readonly', false);
    $("#rg_contact_alleyway").val("");
    $("#rg_contact_alleyway").attr('readonly', false);
    $("#rg_contact_road").val("");
    $("#rg_contact_road").attr('readonly', false);
    $("#rg_contact_vilno").val("");
    $("#rg_contact_vilno").attr('readonly', false);
    $("#rg_contact_district").val("");
    $("#rg_contact_district").attr('readonly', false);
    $("#rg_contact_canton").val("");
    $("#rg_contact_canton").attr('readonly', false);
    $("#rg_contact_province").val("");
    $("#rg_contact_province").attr('readonly', false);
    $("#rg_contact_post").val("");
    $("#rg_contact_post").attr('readonly', false);
    $("#rg_contact_tel").val("");
    $("#rg_contact_tel").attr('readonly', false);
    $("#rg_contact_fax").val("");
    $("#rg_contact_fax").attr('readonly', false);
    $("#rg_contact_road").val("");
    $("#rg_contact_road").attr('readonly', false);
    $("#rg_contact_email").val("");
    $("#rg_contact_email").attr('readonly', false); 
  }
}); 
});
</script>
    <div id="page-wrapper">
        <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">คำร้องทั่วไป</h2>
                </div>
            <div class="panel-body">
                <div class="row">
            <form method="post" action="RequestGeneral_part4.php" id="form">
                <?php
                    $new_id =mysql_result(mysql_query("Select Max(substr(rg_id,-4))+1 as MaxID from tb_general "),0,"MaxID" );
                    if($new_id==''){
                        $rg_id="110000000001";
                    }else{
                        $rg_id="11".sprintf("%010d",$new_id);
                    }
                ?>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>เลขที่คำร้อง</label>
                        <input class="form-control" autocomplete=off  name="rg_id" type="text" id="rg_id" value="<?=$rg_id?>" size="30" readonly/>
                        <input  type="hidden" class="form-control "  name="rg_id" id="rg_id" value="<?=$rg_id?>">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>กฟฟ(สาขา).</label>
                            <input class="form-control"  name="rg_branch" type="text" id="rg_branch" value="<?=$_SESSION[ss_rg_branch]?>" readonly/>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>เจ้าหน้าที่ผู้รับคำร้อง</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="user_id" type="text" id="user_id" value="<?=$user[user_name]?> <?=$user[user_last]?>" readonly/>	
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>วัน/เดือน/ปี</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_date" type="text" id="rg_date" value="<?=date("d/m/").(date("Y")+543)?>"  readonly/>	
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>3.สถานที่ติดต่อ/ที่อยู่ในการจัดส่งเอกสาร</label>
                            <textarea class="form-control"  rows="2" id="rg_contact_place" placeholder="กรุณากรอกข้อมูล" name="rg_contact_place"><?=$_SESSION[ss_rg_contact_place]?></textarea>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <input type="checkbox" id="checkbox-place"><b> ใช้ที่อยู่เดียวกับที่อยู่ผู้ใช้ไฟฟ้า</b>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <b>ที่อยู่:</b> <label>รหัสบ้าน</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_homeid" type="text" id="rg_contact_homeid" value="<?=$_SESSION[ss_rg_contact_homeid]?>" required/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>เลขที่</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_number" type="text" id="rg_contact_number" value="<?=$_SESSION[ss_rg_contact_village]?>" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>หมู่บ้าน/อาคาร</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_village" type="text" id="rg_contact_village" value="<?=$_SESSION[ss_rg_contact_village]?>" required/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ห้อง</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_room" type="text" id="rg_contact_room" value="<?=$_SESSION[ss_rg_contact_room]?>" required/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ชั้น</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_floor" type="text" id="rg_contact_floor" value="<?=$_SESSION[ss_rg_contact_floor]?>" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตรอก</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_alley" type="text" id="rg_contact_alley" value="<?=$_SESSION[ss_rg_contact_alley]?>" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>ซอย</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_alleyway" type="text" id="rg_contact_alleyway" value="<?=$_SESSION[ss_rg_contact_alleyway]?>" required/>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>ถนน</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_road" type="text" id="rg_contact_road" value="<?=$_SESSION[ss_rg_contact_road]?>" required/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>หมู่ที่</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_villno" type="text" id="rg_contact_vilno" value="<?=$_SESSION[ss_rg_contact_villno]?>" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตำบล</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_district" type="text" id="rg_contact_district" value="<?=$_SESSION[ss_rg_contact_district]?>" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>อำเภอ</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_canton" type="text" id="rg_contact_canton" value="<?=$_SESSION[ss_rg_contact_canton]?>" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>จังหวัด</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_province" type="text" id="rg_contact_province" value="<?=$_SESSION[ss_rg_contact_province]?>" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>รหัสไปรษณีย์</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_post" type="text" id="rg_contact_post"  maxlength="5" value="<?=$_SESSION[ss_rg_contact_post]?>" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>โทรศัพท์</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_tel" type="text" id="rg_contact_tel" onkeyup="IsNumeric(this.value,this)" maxlength="10" value="<?=$_SESSION[ss_rg_contact_tel]?>" required/>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>โทรสาร/Fax</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_fax" type="text" id="rg_contact_fax"  onkeyup="IsNumeric(this.value,this)" value="<?=$_SESSION[ss_rg_contact_fax]?>" maxlength="10" required/>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>E-mail</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_contact_email" type="text" id="rg_contact_email" value="<?=$_SESSION[ss_rg_contact_email]?>" required/>
                        </div>
                    </div>
                    <center>
                        <a class="btn btn-info" href="RequestGeneral_part2.php?back=1"><i class="fa fa-arrow-left"> ย้อนกลับ</i></a>
                        <button class="btn  btn-success" name="Submit" type="submit"><i class="fa fa-arrow-right"> ถัดไป</i></button>	
                    </center>
                </div>
                

            </form> 
        </div>

				
            </div>
        </div>

</div>
</body>

</html>
