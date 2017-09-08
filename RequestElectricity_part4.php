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

            <form method="post" action="RequestElectricity_Ses.php?mode=RequestElectricity_part4">
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
                            <label>4.มีความประสงค์</label>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="0" id="re_want_type0">ขอติดตั้งมิเตอร์ใหม่</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="1" id="re_want_type1">ขอตัดฝากมิเตอร์โดยไม่ใช้ไฟฟ้า</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="2" id="re_want_type2">ขอต่อกลับการใช้ไฟฟ้า</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="3" id="re_want_type3">ขอเพื่มขนาดมิเตอร์/อุปกรณ์ประกอบ</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="4" id="re_want_type4">ขอเปลี่ยนประเภทมิเตอร์</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="5" id="re_want_type5">ขอหยุดซ่อมแซมเครื่องจักรประจำปี</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="6" id="re_want_type6">ขอใช้ไฟฟ้าชั่วคราวแบบเหมาจ่าย</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="7" id="re_want_type7">ขอติดตั้งไฟฟ้าชั่วคราว</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="8" id="re_want_type8">ขอตัดฝากมิเตอร์ใช้เพื่อแสงสว่างไม่ลด CT</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="9" id="re_want_type9">ขอยกเลิกเลิกการใช้ไฟฟ้า</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="10" id="re_want_type10">ชอลดขนาดมิเตอร์/อุปกรณ์ประกอบ</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="11" id="re_want_type11">ขอใช้ไฟฟ้าสาธารณะ</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="12" id="re_want_type12">ขอตัดมิเตอร์ใช้เพื่อแสงสว่างลด CT</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="13" id="re_want_type13">ขอย้ายจุดติดตั้งมิเตอร์/อุปกรณ์ประกอบ</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="14" id="re_want_type14">ขอเปลี่ยนมิเตอร์กรณีชำรุด</label>
                            </div>
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" value="15" id="re_want_type15">ขอใช้ไฟฟ้าตู้โทรศัพท์ต่อตรง</label>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <div class="radio">
                                <label><input name="re_want_type" size="30" type="radio" id="re_want_type16" value="16" >อื่นๆ ระบุ:</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-10">
                            <input class="form-control"  name="re_want_other" type="text" id="re_want_other">	
                        </div> 
                    </div>
                        <div class="form-group col-sm-12">
                            <label>รายละเอียดเพื่มเติม</label>
                            <textarea class="form-control"  rows="2" id="re_detail" placeholder="กรุณากรอกข้อมูล" name="re_detail"><?=$_SESSION['re_detail']?></textarea>
                        </div> 
                </div>
<script type="text/javascript">
$(document).ready(function() {
$("#re_want_other").attr('disabled', true);
$("#re_want_type0").attr('checked', true);

$("#re_want_type0").click(function(){
    $("#re_want_other").attr('disabled', true);
});
$("#re_want_type1").click(function(){
    $("#re_want_other").attr('disabled', true);
});
$("#re_want_type2").click(function(){
    $("#re_want_other").attr('disabled', true);
});
$("#re_want_type3").click(function(){
    $("#re_want_other").attr('disabled', true);
});
$("#re_want_type4").click(function(){
    $("#re_want_other").attr('disabled', true);
});
$("#re_want_type5").click(function(){
    $("#re_want_other").attr('disabled', true);
});
$("#re_want_type6").click(function(){
    $("#re_want_other").attr('disabled', true);
});
$("#re_want_type7").click(function(){
    $("#re_want_other").attr('disabled', true);
});
$("#re_want_type8").click(function(){
    $("#re_want_other").attr('disabled', true);
});
$("#re_want_type9").click(function(){
    $("#re_want_other").attr('disabled', true);
});
$("#re_want_type10").click(function(){
    $("#re_want_other").attr('disabled', true);
});
$("#re_want_type11").click(function(){
    $("#re_want_other").attr('disabled', true);
});
$("#re_want_type12").click(function(){
    $("#re_want_other").attr('disabled', true);
});
$("#re_want_type13").click(function(){
    $("#re_want_other").attr('disabled', true);
});
$("#re_want_type14").click(function(){
    $("#re_want_other").attr('disabled', true);
});
$("#re_want_type15").click(function(){
    $("#re_want_other").attr('disabled', true);
});
$("#re_want_type16").click(function(){
    $("#re_want_other").attr('disabled', false);
});

});
</script>
                    <center>
                        <input  type="hidden" class="form-control " name="newcus" id="add" value="addcus">
                        <a class="btn btn-info" onclick="location.href='RequestElectricity_part3.php'"><i class="fa fa-arrow-left"> ย้อนกลับ</i></a>
                        <button class="btn  btn-success" name="Submit" type="submit"><i class="fa fa-arrow-right"> ถัดไป</i></button>	
                    </center>
                </div>
            </form> 
        </div>

				
            </div>
        </div>
</body>

</html>
