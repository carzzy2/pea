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
    $_SESSION[ss_rg_contact_place]=$_POST[rg_contact_place];
    $_SESSION[ss_rg_contact_homeid]=$_POST[rg_contact_homeid];
    $_SESSION[ss_rg_contact_number]=$_POST[rg_contact_number];
    $_SESSION[ss_rg_contact_village]=$_POST[rg_contact_village];
    $_SESSION[ss_rg_contact_room]=$_POST[rg_contact_room];
    $_SESSION[ss_rg_contact_floor]=$_POST[rg_contact_floor];
    $_SESSION[ss_rg_contact_alley]=$_POST[rg_contact_alley];
    $_SESSION[ss_rg_contact_alleyway]=$_POST[rg_contact_alleyway];
    $_SESSION[ss_rg_contact_road]=$_POST[rg_contact_road];
    $_SESSION[ss_rg_contact_villno]=$_POST[rg_contact_villno];
    $_SESSION[ss_rg_contact_district]=$_POST[rg_contact_district];
    $_SESSION[ss_rg_contact_canton]=$_POST[rg_contact_canton];
    $_SESSION[ss_rg_contact_province]=$_POST[rg_contact_province];
    $_SESSION[ss_rg_contact_post]=$_POST[rg_contact_post];
    $_SESSION[ss_rg_contact_tel]=$_POST[rg_contact_tel];
    $_SESSION[ss_rg_contact_fax]=$_POST[rg_contact_fax];
    $_SESSION[ss_rg_contact_road]=$_POST[rg_contact_road];
    $_SESSION[ss_rg_contact_email]=$_POST[rg_contact_email];
 }

?>
    <div id="page-wrapper">
        <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">คำร้องทั่วไป</h2>
                </div>
            <div class="panel-body">
                 <div class="row">
            <form method="post" action="RequestGeneral_save.php" id="form">
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
                            <label>4. มีความประสงค์</label>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="form-group col-sm-5">
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="0" id="rg_want_type0">ขอรับเงินประกันการใช้ไฟฟ้าคืน</label>
                            </div>
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="1" id="rg_want_type1">ขอรับเงินประกันคาปาซิเตอร์คืน</label>
                            </div>
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="2" id="rg_want_type2">ขอรับเงินประกันหม้อแปลงไฟฟ้าคืน</label>
                            </div>
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="3" id="rg_want_type3">ขอรับค่าขยายเขตระบบจำหน่ายไฟฟ้าคืน</label>
                            </div>
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="4" id="rg_want_type4">ขอใช้บริการพิมพ์โฆษณาหลังใบแจ้งหนี้/ใบเสร็จรับเงิน</label>
                            </div>
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="5" id="rg_want_type5">ขอชำระเงินค่าไฟฟ้าโดยหักจากบัญชีเงินฝากธนาคาร</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-5">
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="6" id="rg_want_type6">ขอเช่าพื้นที่โฆษณา</label>
                            </div>
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="7" id="rg_want_type7">ขอเช่าพาดสายโทรนาคม</label>
                            </div>
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="8" id="rg_want_type8">ขอเช่าสาย fiber optic</label>
                            </div>
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="9" id="rg_want_type9">ขอเช่าที่ดิน</label>
                            </div>
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="10" id="rg_want_type10">ขอซื้อที่ดิน</label>
                            </div>
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" value="11" id="rg_want_type11">ขอใช้ไฟฟ้าที่ กฟภ. สนับสนุน</label>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <div class="radio">
                                <label><input name="rg_want_type" size="30" type="radio" id="rg_want_type12" value="12" >อื่นๆ ระบุ:</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-10">
                            <input class="form-control"  name="rg_want_other" type="text" id="rg_want_other" required>	
                        </div> 
                    </div>
                        <div class="form-group col-sm-12">
                            <label>รายละเอียดเพื่มเติม</label>
                            <textarea class="form-control"  rows="2" id="rg_detail" placeholder="กรุณากรอกข้อมูล" name="rg_detail" required><?=$array_edit[rg_detail]?></textarea>
                        </div> 
                    <center>
                        <a class="btn btn-info" href="RequestGeneral_part3.php?back=1"><i class="fa fa-arrow-left"> ย้อนกลับ</i></a>
                        <button class="btn  btn-success" name="Submit" type="submit"><i class="fa fa-check"> บันทึก</i></button>	
                    </center>
                </div>
<script type="text/javascript">
$(document).ready(function() {
$("#rg_want_type0").attr('checked', true);
$("#rg_want_other").attr('disabled', true);

$("#rg_want_type0").click(function(){
    $("#rg_want_other").attr('disabled', true);
});
$("#rg_want_type1").click(function(){
    $("#rg_want_other").attr('disabled', true);
});
$("#rg_want_type2").click(function(){
    $("#rg_want_other").attr('disabled', true);
});
$("#rg_want_type3").click(function(){
    $("#rg_want_other").attr('disabled', true);
});
$("#rg_want_type4").click(function(){
    $("#rg_want_other").attr('disabled', true);
});
$("#rg_want_type5").click(function(){
    $("#rg_want_other").attr('disabled', true);
});
$("#rg_want_type6").click(function(){
    $("#rg_want_other").attr('disabled', true);
});
$("#rg_want_type7").click(function(){
    $("#rg_want_other").attr('disabled', true);
});
$("#rg_want_type8").click(function(){
    $("#rg_want_other").attr('disabled', true);
});
$("#rg_want_type9").click(function(){
    $("#rg_want_other").attr('disabled', true);
});
$("#rg_want_type10").click(function(){
    $("#rg_want_other").attr('disabled', true);
});
$("#rg_want_type11").click(function(){
    $("#rg_want_other").attr('disabled', true);
});
$("#rg_want_type12").click(function(){
    $("#rg_want_other").attr('disabled', false);
});

});
</script>
            </form> 
        </div>

				
            </div>
        </div>

</div>
</body>

</html>
