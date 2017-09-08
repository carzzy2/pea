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
<?php include "header.php";
?>

<?php
    include"sidebar.php"; 
?>
 <?php
 function Dateim($mydate){
    $d=split("-",$mydate);
    $mydate=$d[2]."/".$d[1]."/".($d[0]+543);
    return "$mydate";
}
    $sql="select * from tb_equipment,tb_electricity,tb_user where tb_equipment.equ_id='".$_GET[id]."' and tb_equipment.re_id=tb_electricity.re_id and tb_equipment.user_id = tb_user.user_id  ";
    $result=mysql_db_query($dbname,$sql);
    $array=mysql_fetch_array($result);
?>
    <div id="page-wrapper">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="panel-title">รายละเอียดการสำรวจหน้างานเลขที่ <?=$_GET[id]?> </h2>
            </div>
            <div class="panel-body">
                <form method="post" action="StatusElectricity_save">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-3 form-group">
                                <label>เลขที่คำร้อง</label>
                                <input class="form-control" autocomplete=off  name="re_id" type="text" id="re_id" value="<?= $array[re_id] ?>" size="30" readonly/>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>กฟฟ(สาขา).</label>
                                <input  type="text" class="form-control"  value="<?= $array['re_branch'] ?>" readonly>		
                            </div>
                            
                            <div class="col-sm-3 form-group">
                                <label>วัน/เดือน/ปี</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_date" type="text" id="re_date" value="<?= Dateim($array[equ_date]);?>"  readonly/>	
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>เจ้าหน้าที่ที่สำรวจ</label>
                                <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_date" type="text" id="re_date" value="<?=$array[user_name];?> <?=$array[user_last];?>"  readonly/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label>อุปกรณ์ที่ใช้ติดตั้ง</label>
                                </div>
                            </div>    
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label>(1)หม้อแปลงขนาด</label>
                                    <div class="form-group input-group">
                                        <input type="text" class="form-control" placeholder="กรุณากรอกข้อมูล" name="equ_tran" value="<?= $array[equ_tran] ?>" readonly>
                                        <span class="input-group-addon">เควีเอ.</span>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>จำนวน</label>
                                    <div class="form-group input-group">
                                        <input type="number" class="form-control" placeholder="กรุณากรอกข้อมูล" name="equ_tran_unit"  value="<?= $array[equ_tran_unit] ?>" readonly>
                                        <span class="input-group-addon">เครื่อง</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label>(2)เครื่องปรับอากาศ</label>
                                    <div class="form-group input-group">
                                        <input type="text" class="form-control" placeholder="กรุณากรอกข้อมูล" name="equ_air" value="<?= $array[equ_air] ?>" readonly>
                                        <span class="input-group-addon">บีทียู</span>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>จำนวน</label>
                                    <div class="form-group input-group">
                                        <input type="number" class="form-control" placeholder="กรุณากรอกข้อมูล" name="equ_air_unit" value="<?= $array[equ_air_unit] ?>" readonly>
                                        <span class="input-group-addon">เครื่อง</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label>(3)ดวงโคม</label>
                                    <div class="form-group input-group">
                                        <input type="number" class="form-control" placeholder="กรุณากรอกข้อมูล" name="equ_lantern" value="<?= $array[equ_lantern] ?>" readonly>
                                        <span class="input-group-addon">ดวง</span>
                                    </div>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label>(4)เต้าเสียบ</label>
                                    <div class="form-group input-group">
                                        <input type="number" class="form-control" placeholder="กรุณากรอกข้อมูล" name="equ_outlet" value="<?= $array[equ_outlet] ?>" readonly>
                                        <span class="input-group-addon">ชุด</span>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>(5)พัดลม</label>
                                    <div class="form-group input-group">
                                        <input type="number" class="form-control" placeholder="กรุณากรอกข้อมูล" name="equ_fan" value="<?= $array[equ_fan] ?>" readonly>
                                        <span class="input-group-addon">เครื่อง</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-8">
                                    <label>(6)อื่นๆ ระบุ</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="equ_other" value="<?= $array[equ_other] ?>" readonly> 
                                    </div>
                                </div>

                            </div>
                        </div>
                        <center>
                            <a class="btn btn-info" onclick="location.href='StatusElectricity.php'"> ย้อนกลับ</a>                     
                        </center>
                    </div>
                </form> 
            </div>


        </div>
    </div>
</body>

</html>
