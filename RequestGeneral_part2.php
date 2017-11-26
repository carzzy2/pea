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
 if($_POST[newcus]=="addcus"){
     $add="newcus";
     $_SESSION[ss_rg_branch]=$_POST[rg_branch];
     $_SESSION[ss_cus_id]=$_POST[cus_id];
     $_SESSION[ss_cus_first]=$_POST[cus_first];
     $_SESSION[ss_cus_name]=$_POST[cus_name];
     $_SESSION[ss_cus_type]=$_POST[cus_type];
     $_SESSION[ss_cus_tax]=$_POST[cus_tax];
     $_SESSION[ss_cus_code]=$_POST[cus_code];
     
     $_SESSION[ss_cus_homeid]=$_POST[cus_homeid];
     $_SESSION[ss_cus_number]=$_POST[cus_number];
     $_SESSION[ss_cus_village]=$_POST[cus_village];
     $_SESSION[ss_cus_room]=$_POST[cus_room];
     $_SESSION[ss_cus_floor]=$_POST[cus_floor];
     $_SESSION[ss_cus_alley]=$_POST[cus_alley];
     $_SESSION[ss_cus_alleyway]=$_POST[cus_alleyway];
     $_SESSION[ss_cus_road]=$_POST[cus_road];
     $_SESSION[ss_cus_vilno]=$_POST[cus_vilno];
     $_SESSION[ss_cus_district]=$_POST[cus_district];
     $_SESSION[ss_cus_canton]=$_POST[cus_canton];
     $_SESSION[ss_cus_province]=$_POST[cus_province];
     $_SESSION[ss_cus_post]=$_POST[cus_post];
     $_SESSION[ss_cus_tel]=$_POST[cus_tel];
     $_SESSION[ss_cus_fax]=$_POST[cus_fax];
     $_SESSION[ss_cus_road]=$_POST[cus_road];
     $_SESSION[ss_cus_email]=$_POST[cus_email];

 }else{
     $sql="select * from tb_customer where cus_code like '%".$_POST[search]."%' order by cus_id";
     $result=mysql_db_query($dbname,$sql);
     $place_data=mysql_fetch_array($result);
     
     $_SESSION[ss_cus_id]=$place_data[cus_id];
     $_SESSION[ss_cus_first]=$place_data[cus_first];
     $_SESSION[ss_cus_name]=$place_data[cus_name];
     $_SESSION[ss_cus_type]=$place_data[cus_type];
     $_SESSION[ss_cus_tax]=$place_data[cus_tax];
     $_SESSION[ss_cus_code]=$place_data[cus_code];
     
     $_SESSION[ss_cus_homeid]=$place_data[cus_homeid];
     $_SESSION[ss_cus_number]=$place_data[cus_number];
     $_SESSION[ss_cus_village]=$place_data[cus_village];
     $_SESSION[ss_cus_room]=$place_data[cus_room];
     $_SESSION[ss_cus_floor]=$place_data[cus_floor];
     $_SESSION[ss_cus_alley]=$place_data[cus_alley];
     $_SESSION[ss_cus_alleyway]=$place_data[cus_alleyway];
     $_SESSION[ss_cus_road]=$place_data[cus_road];
     $_SESSION[ss_cus_vilno]=$place_data[cus_vilno];
     $_SESSION[ss_cus_district]=$place_data[cus_district];
     $_SESSION[ss_cus_canton]=$place_data[cus_canton];
     $_SESSION[ss_cus_province]=$place_data[cus_province];
     $_SESSION[ss_cus_post]=$place_data[cus_post];
     $_SESSION[ss_cus_tel]=$place_data[cus_tel];
     $_SESSION[ss_cus_fax]=$place_data[cus_fax];
     $_SESSION[ss_cus_road]=$place_data[cus_road];
     $_SESSION[ss_cus_email]=$place_data[cus_email];
     $add="oldcus";
 }
 }
?>
    <script type="text/javascript">
$(document).ready(function() {
$("#checkbox-place").click(function(){
    if ($(this).is(':checked')) {
    $("#rg_place_homeid").val("<?= $_SESSION[ss_cus_homeid] ?>");
    $("#rg_place_homeid").attr('readonly', true);
    $("#rg_place_number").val("<?= $_SESSION[ss_cus_number] ?>");
    $("#rg_place_number").attr('readonly', true);
    $("#rg_place_village").val("<?= $_SESSION[ss_cus_village] ?>");
    $("#rg_place_village").attr('readonly', true);
    $("#rg_place_room").val("<?= $_SESSION[ss_cus_room] ?>");
    $("#rg_place_room").attr('readonly', true);
    $("#rg_place_floor").val("<?= $_SESSION[ss_cus_floor] ?>");
    $("#rg_place_floor").attr('readonly', true);
    $("#rg_place_alley").val("<?= $_SESSION[ss_cus_alley] ?>");
    $("#rg_place_alley").attr('readonly', true);
    $("#rg_place_alleyway").val("<?= $_SESSION[ss_cus_alleyway] ?>");
    $("#rg_place_alleyway").attr('readonly', true);
    $("#rg_place_road").val("<?= $_SESSION[ss_cus_road] ?>");
    $("#rg_place_road").attr('readonly', true);
    $("#rg_place_vilno").val("<?= $_SESSION[ss_cus_vilno] ?>");
    $("#rg_place_vilno").attr('readonly', true);
    $("#rg_place_district").val("<?= $_SESSION[ss_cus_district] ?>");
    $("#rg_place_district").attr('readonly', true);
    $("#rg_place_canton").val("<?= $_SESSION[ss_cus_canton] ?>");
    $("#rg_place_canton").attr('readonly', true);
    $("#rg_place_province").val("<?= $_SESSION[ss_cus_province] ?>");
    $("#rg_place_province").attr('readonly', true);
    $("#rg_place_post").val("<?= $_SESSION[ss_cus_post] ?>");
    $("#rg_place_post").attr('readonly', true);
    $("#rg_place_tel").val("<?= $_SESSION[ss_cus_tel] ?>");
    $("#rg_place_tel").attr('readonly', true);
    $("#rg_place_fax").val("<?= $_SESSION[ss_cus_fax] ?>");
    $("#rg_place_fax").attr('readonly', true);
    $("#rg_place_road").val("<?= $_SESSION[ss_cus_road] ?>");
    $("#rg_place_road").attr('readonly', true);
    $("#rg_place_email").val("<?= $_SESSION[ss_cus_email] ?>");
    $("#rg_place_email").attr('readonly', true);
  }else{
     $("#rg_place_homeid").val("");
    $("#rg_place_homeid").attr('readonly', false);
    $("#rg_place_number").val("");
    $("#rg_place_number").attr('readonly', false);
    $("#rg_place_village").val("");
    $("#rg_place_village").attr('readonly', false);
    $("#rg_place_room").val("");
    $("#rg_place_room").attr('readonly', false);
    $("#rg_place_floor").val("");
    $("#rg_place_floor").attr('readonly', false);
    $("#rg_place_alley").val("");
    $("#rg_place_alley").attr('readonly', false);
    $("#rg_place_alleyway").val("");
    $("#rg_place_alleyway").attr('readonly', false);
    $("#rg_place_road").val("");
    $("#rg_place_road").attr('readonly', false);
    $("#rg_place_vilno").val("");
    $("#rg_place_vilno").attr('readonly', false);
    $("#rg_place_district").val("");
    $("#rg_place_district").attr('readonly', false);
    $("#rg_place_canton").val("");
    $("#rg_place_canton").attr('readonly', false);
    $("#rg_place_province").val("");
    $("#rg_place_province").attr('readonly', false);
    $("#rg_place_post").val("");
    $("#rg_place_post").attr('readonly', false);
    $("#rg_place_tel").val("");
    $("#rg_place_tel").attr('readonly', false);
    $("#rg_place_fax").val("");
    $("#rg_place_fax").attr('readonly', false);
    $("#rg_place_road").val("");
    $("#rg_place_road").attr('readonly', false);
    $("#rg_place_email").val("");
    $("#rg_place_email").attr('readonly', false); 
  }
}); 


$("#rg_place_other").attr('disabled', true);
$("#disable").attr('checked', true);

$("#disable").click(function(){
    $("#rg_place_other").attr('disabled', true);
});
$("#enable").click(function(){
    $("#rg_place_other").attr('disabled', false);
});
$("#disable1").click(function(){
    $("#rg_place_other").attr('disabled', true);
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
            <form method="post" action="RequestGeneral_part3.php" id="form">
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
                            <?php if($_POST[newcus]=="addcus"){?>
                            <input class="form-control"  name="rg_branch" type="text" id="rg_branch" value="<?=$_POST[rg_branch]?>" readonly/>
                            <?php }else{ ?>
                            <select class="form-control" name="rg_branch" id="rg_branch" required/>
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
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_date" type="text" id="rg_date" value="<?=date("d/m/").(date("Y")+543)?>"  readonly/>	
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label>2.สถานที่ขอใช้บริการ</label>
                        </div>
                        <div class="form-group col-sm-3">
                            <div class="radio-inline">
                                <label><input name="rg_place_type" size="30" type="radio" value="0" id="disable" <?php if($_SESSION['rg_place_type']=="0"){ echo "checked"; }?>>เอกชน</label>
                            </div>
                            <div class="radio-inline">
                                <label><input name="rg_place_type" size="30" type="radio" value="1" id="disable1" <?php if($_SESSION['rg_place_type']=="1"){ echo "checked"; }?>>ราชการ</label>
                            </div>
                            <div class="radio-inline">
                                <label><input name="rg_place_type" size="30" type="radio" value="2" id="enable" <?php if($_SESSION['rg_place_type']=="2"){ echo "checked"; }?>>อื่นๆ(ระบุ)</label>
                            </div>
   
                        </div>
                        <div class="form-group col-sm-4">
                            <input class="form-control" name="rg_place_other" type="text" id="rg_place_other" value="<?=$_SESSION[ss_rg_place_other]?>">	
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>ชื่อสถานที่ใช้ไฟฟ้า</label>
                            <textarea class="form-control"  rows="2" id="rg_place_name" placeholder="กรุณากรอกข้อมูล" name="rg_place_name"><?=$_SESSION[ss_rg_place_name]?></textarea>
                        </div>
                        <div class="form-group col-sm-12">
                            <input type="checkbox" id="checkbox-place"><b> ใช้ที่อยู่เดียวกับที่อยู่ผู้ใช้ไฟฟ้า</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <b>ที่อยู่:</b> <label>รหัสบ้าน</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_homeid" type="text" id="rg_place_homeid" value="<?=$_SESSION[ss_rg_place_homeid]?>" required/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>เลขที่</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_number" type="text" id="rg_place_number" value="<?=$_SESSION[ss_rg_place_number]?>" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>หมู่บ้าน/อาคาร</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_village" type="text" id="rg_place_village" value="<?=$_SESSION[ss_rg_place_village]?>" required/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ห้อง</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_room" type="text" id="rg_place_room" value="<?=$_SESSION[ss_rg_place_room]?>" required/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>ชั้น</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_floor" type="text" id="rg_place_floor" value="<?=$_SESSION[ss_rg_place_floor]?>" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตรอก</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_alley" type="text" id="rg_place_alley" value="<?=$_SESSION[ss_rg_place_alley]?>" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>ซอย</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_alleyway" type="text" id="rg_place_alleyway" value="<?=$_SESSION[ss_rg_place_alleyway]?>" required/>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>ถนน</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_road" type="text" id="rg_place_road" value="<?=$_SESSION[ss_rg_place_road]?>" required/>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>หมู่ที่</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_villno" type="text" id="rg_place_vilno" value="<?=$_SESSION[ss_rg_place_vilno]?>" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>ตำบล</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_district" type="text" id="rg_place_district" value="<?=$_SESSION[ss_rg_place_district]?>" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>อำเภอ</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_canton" type="text" id="rg_place_canton" value="<?=$_SESSION[ss_rg_place_canton]?>" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>จังหวัด</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_province" type="text" id="rg_place_province" value="<?=$_SESSION[ss_rg_place_province]?>" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>รหัสไปรษณีย์</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_post" type="text" id="rg_place_post" value="<?=$_SESSION[ss_rg_place_post]?>" maxlength="5" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>โทรศัพท์</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_tel" type="text" id="rg_place_tel" value="<?=$_SESSION[ss_rg_place_tel]?>" onkeyup="IsNumeric(this.value,this)" maxlength="10" >
                        </div>
                        <div class="form-group col-sm-4">
                            <label>โทรสาร/Fax</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_fax" type="text" id="rg_place_fax" value="<?=$_SESSION[ss_rg_place_fax]?>" onkeyup="IsNumeric(this.value,this)" maxlength="10" >
                        </div>
                        <div class="form-group col-sm-4">
                            <label>E-mail</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_place_email" type="text" id="rg_place_email" value="<?=$_SESSION[ss_rg_place_email]?>" required/>
                        </div>
                        <div class="form-group col-sm-12">
                            <label>ประเภทกิจการ</label>
                            <textarea class="form-control"  rows="2" id="rg_place_service" placeholder="กรุณากรอกข้อมูล" name="rg_place_service"><?=$_SESSION[ss_rg_place_service]?></textarea>
                        </div>
                    </div>
                <center>
                    <input  type="hidden" class="form-control " name="add" id="add" value="<?=$add?>">
                    <a class="btn btn-info" href="RequestGeneral_part1.php?back=1"><i class="fa fa-arrow-left"> ย้อนกลับ</i></a>
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
