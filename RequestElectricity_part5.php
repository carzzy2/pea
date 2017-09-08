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

            <form method="post" action="RequestElectricity_Ses.php?mode=RequestElectricity_part5">
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
                            <label>5.ประเภทการใช้ไฟฟ้า</label>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <div class="radio">
                                <label><input name="re_use_type" size="30" type="radio" value="0" id="re_use_type0">บ้านที่อยู่อาศัย</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_use_type" size="30" type="radio" value="1" id="re_use_type1">กิจการเฉพาะอย่าง</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <div class="radio">
                                <label><input name="re_use_type" size="30" type="radio" value="2" id="re_use_type2">กิจการขนาดเล็ก</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_use_type" size="30" type="radio" value="3" id="re_use_type3">ราชการ/องค์กรไม่แสวงหากำไร CT</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <div class="radio">
                                <label><input name="re_use_type" size="30" type="radio" value="4" id="re_use_type4">กิจการขนาดกลาง</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_use_type" size="30" type="radio" value="5" id="re_use_type5">สูบน้ำเพื่อการเกษตร CT</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <div class="radio">
                                <label><input name="re_use_type" size="30" type="radio" value="6" id="re_use_type6">กิจการขนาดใหญ่</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_use_type" size="30" type="radio" value="7" id="re_use_type7">ไฟฟ้าชั่วคราว</label>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <div class="radio">
                                <label><input name="re_use_type" size="30" type="radio" id="re_use_type8" value="8">อื่นๆ ระบุ:</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-10">
                            <input class="form-control"  name="re_use_other" type="text" id="re_use_other" >	
                        </div> 
                    </div>
                </div>
<script type="text/javascript">
$(document).ready(function() {
$("#re_use_other").attr('disabled', true);
$("#re_use_type0").attr('checked', true);
$("#re_keep_type").attr('checked', true)
$("#re_use_type0").click(function(){
    $("#re_use_other").attr('disabled', true);
});
$("#re_use_type1").click(function(){
    $("#re_use_other").attr('disabled', true);
});
$("#re_use_type2").click(function(){
    $("#re_use_other").attr('disabled', true);
});
$("#re_use_type3").click(function(){
    $("#re_use_other").attr('disabled', true);
});
$("#re_use_type4").click(function(){
    $("#re_use_other").attr('disabled', true);
});
$("#re_use_type5").click(function(){
    $("#re_use_other").attr('disabled', true);
});
$("#re_use_type6").click(function(){
    $("#re_use_other").attr('disabled', true);
});
$("#re_use_type7").click(function(){
    $("#re_use_other").attr('disabled', true);
});

$("#re_use_type8").click(function(){
    $("#re_use_other").attr('disabled', false);
});

});
</script>
                    <center>
                        <input  type="hidden" class="form-control " name="newcus" id="add" value="addcus">
                        <a class="btn btn-info" onclick="location.href='RequestElectricity_part4.php'"><i class="fa fa-arrow-left"> ย้อนกลับ</i></a>
                        <button class="btn  btn-success" name="Submit" type="submit"><i class="fa fa-arrow-right"> ถัดไป</i></button>	
                    </center>
                </div>
            </form> 
        </div>

				
            </div>
        </div>
</body>

</html>
