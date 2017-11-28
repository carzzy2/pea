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
if($_GET[mode]==""){
	$mode="add";
	$str="เพิ่มข้อมูล";
}elseif($_GET[mode]=="edit"){
	$enable="disabled=disabled";
	$mode=$_GET[mode];
	$id=$_GET[id];
	$str="แก้ไข";
	$sql_edit="select * from tb_user where user_id='".$id."'";
	$result_edit=mysql_db_query($dbname,$sql_edit);
	$array_edit=mysql_fetch_array($result_edit);
}
?>
    <div id="page-wrapper">
        <div class="col-sm-12 ">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title"><?=$str?>เจ้าหน้าที่</h2>
                </div>
            <div class="panel-body">
            <div class="col-sm-12">
                <div class="row">
                    <form method="post" id="frm_user" name="frm_user" action="user_save.php" onsubmit="return check_null()">
                <?php
                    $new_id =mysql_result(mysql_query("Select Max(substr(user_id,-4))+1 as MaxID from tb_user"),0,"MaxID" );
                    if($new_id==''){ // ถ้าได้เป็นค่าว่าง หรือ null ก็แสดงว่ายังไม่มีข้อมูลในฐานข้อมูล
                    $std_id="EMP00001";
                    }else{
                    $std_id="EMP".sprintf("%05d",$new_id);//ถ้าไม่ใช่ค่าว่าง
                    }
                ?>
                <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>รหัสเจ้าหน้าที่</label>
                            <? if($_GET[mode]=="edit"){ ?>
                            <input placeholder="กรุณากรอกข้อมูล" size="30" class="form-control" name="user_id1" type="text" id="user_id1" value="<?=$array_edit[user_id]?>"<?=$enable?>/>
                            <input  type="hidden" class="form-control "  name="user_id" id="user_id" value="<?=$array_edit[user_id]?>">
                            <?}elseif($_GET[mode]==""){ ?>
                            <input class="form-control" autocomplete=off  name="user_id" type="text" id="user_id1" value="<?=$std_id?>" size="30" readonly/>
                            <input  type="hidden" class="form-control "  name="user_id" id="user_id" value="<?=$std_id?>">
                            <? } ?>	
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>รหัสประชาชน</label> <!--<label style="color: red; font-weight: normal;">*กรอกตัวเลข13 หลัก</label> -->
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="user_code" type="text" id="user_code" value="<?=$array_edit[user_code]?>" onkeyup="IsNumeric(this.value,this)" maxlength="13" required/>	
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-3 form-group">
                                <label>คำนำหน้า</label>
                                <select id="user_first" class="form-control" name="user_first" required>
                                    <option style="display: none">--กรุณาเลือก--</option>
                                    <option value="0" <?php if($array_edit['user_first']=="0"){ echo "selected=selected"; }?>>นาย</option>
                                    <option value="1" <?php if($array_edit['user_first']=="1"){ echo "selected=selected"; }?>>นาง</option>
                                    <option value="2" <?php if($array_edit['user_first']=="2"){ echo "selected=selected"; }?>>นางสาว</option>
                                </select>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>ชื่อพนักงาน</label>
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="user_name" type="text" id="user_name" value="<?=$array_edit[user_name]?>" onkeypress="chThai()" required/>	
                            </div>
                            <div class="col-sm-5 form-group">
                                <label>นามสกุล</label>
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="user_last" type="text" id="user_last" value="<?=$array_edit[user_last]?>" onkeypress="chThai()" required/>	
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-5">
                                <label>ที่อยู่</label>
                                <textarea placeholder="กรุณากรอกข้อมูล" rows="1" name="user_add" class="form-control" required/><?=$array_edit[user_add]?></textarea>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>เบอร์โทรศัพท์</label>
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="user_tel" type="text" id="user_tel" value="<?=$array_edit[user_tel]?>" onkeyup="IsNumeric(this.value,this)" maxlength="10" required/>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>ตำแหน่ง</label>
                                <div class="radio">
                                    <label><input disabled  name="user_pos" id="user_pos1" size="30" type="radio" value="0" <?php if($array_edit['user_pos']=="0"){ echo "checked"; }?>>&nbsp;ผู้ดูแลระบบ&nbsp;</label>
                                    <label><input disabled  name="user_pos" id="user_pos2" size="30" type="radio" value="1" <?php if($array_edit['user_pos']=="1"){ echo "checked"; }?>>&nbsp;พนักงาน&nbsp;</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>รหัสผ่าน</label>
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="user_pass1" type="password" id="user_pass1" value="<?=$array_edit[user_pass]?>" >
                            </div>
                        </div>
                         <div class="row">
                            <div class="form-group col-sm-6">
                                <label>ยืนยันรหัสผ่าน</label><code>*กรุณากรอกรหัสผ่านให้ตรงกัน</code>
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="user_pass2" type="password" id="user_pass2" value="<?=$array_edit[user_pass]?>">
                            </div>
                        </div>
                    <script type="text/javascript">
                    $(document).ready(function() {
                    $("#user_pos2").attr('checked', true);
                    });
                    </script>
                    <script>
                    function check_null(){
                     var pass = $("#user_pass1").val();
                     var pass2 = $("#user_pass2").val();
                     
//                     if(pass.length < 6 || pass2.length <6){
//                        alert("กรุณากรอก Password !");
//                        $("#user_pass").focus();
//                      return false;
//                     }
                     
                     if(pass == ''){
                      alert("กรุณากรอก Password !");
                      $("#user_pass").focus();
                      return false;
                     }
                     if(pass2 == ''){
                        alert("กรุณากรอก Password อีกครั้ง !");
                        $("#user_pass2").focus();
                        return false;
                     }
                     if(pass != pass2){
                        alert("Password ไม่ตรงกัน!");
                        $("#user_pass2").focus();
                        return false;
                     }
                    }
                    </script>
                    <center>
                        <button class="btn  btn-success" name="Submit" type="submit"><i class="fa fa-check" > <?=$str?></i></button>
                        <input name="txtmode" type="hidden" id="txtmode" value="<?=$mode?>" />
                        <input name="txtid" type="hidden" id="txtid" value="<?=$id?>" />
                        <a class="btn btn-info" onclick="location.href='user_show.php'"><i class="fa fa-times"> ยกเลิก</i></a>	
                    </center>
                </div>
            </form> 
        </div>
            </div>  					
        </div>
        </div>
    </div>
</div>

</body>

</html>
