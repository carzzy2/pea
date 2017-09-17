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
                                    <div class="form-group">
                                    <select id="equ_tran" class="form-control" name="equ_tran" disabled>
                                        <option value=""><-- เลือกขนาดหม้อแปลง --></option>
                                        <option value="1 เฟส ขนาด 30 KVA" <?php if($array[equ_tran]=="1 เฟส ขนาด 30 KVA"){ echo "selected";} ?>> 1 เฟส ขนาด 30 KVA</option>
                                        <option value="3 เฟส ขนาด 50 KVA" <?php if($array[equ_tran]=="3 เฟส ขนาด 50 KVA"){ echo "selected";} ?>>3 เฟส ขนาด 50 KVA</option>
                                        <option value="3 เฟส ขนาด 100 KVA" <?php if($array[equ_tran]=="3 เฟส ขนาด 100 KVA"){ echo "selected";} ?>> 3 เฟส ขนาด 100 KVA</option>
                                        <option value="3 เฟส ขนาด 160 KVA" <?php if($array[equ_tran]=="3 เฟส ขนาด 160 KVA"){ echo "selected";} ?>> 3 เฟส ขนาด 160 KVA</option>
                                        <option value="3 เฟส ขนาด 250 KVA" <?php if($array[equ_tran]=="3 เฟส ขนาด 250 KVA"){ echo "selected";} ?>> 3 เฟส ขนาด 250 KVA</option>
                                        <option value="3 เฟส ขนาด 315 KVA" <?php if($array[equ_tran]=="3 เฟส ขนาด 315 KVA"){ echo "selected";} ?>> 3 เฟส ขนาด 315 KVA</option>
                                        <option value="3 เฟส ขนาด 400 KVA" <?php if($array[equ_tran]=="3 เฟส ขนาด 400 KVA"){ echo "selected";} ?>> 3 เฟส ขนาด 400 KVA</option>
                                        <option value="3 เฟส ขนาด 500 KVA" <?php if($array[equ_tran]=="3 เฟส ขนาด 500 KVA"){ echo "selected";} ?>> 3 เฟส ขนาด 500 KVA</option>
                                        <option value="3 เฟส ขนาด 1000 KVA" <?php if($array[equ_tran]=="3 เฟส ขนาด 1000 KVA"){ echo "selected";} ?>> 3 เฟส ขนาด 1000 KVA</option>
                                        <option value="3 เฟส ขนาด 1250 KVA" <?php if($array[equ_tran]=="3 เฟส ขนาด 1250 KVA"){ echo "selected";} ?>> 3 เฟส ขนาด 1250 KVA</option>
                                        <option value="3 เฟส ขนาด 2000 KVA" <?php if($array[equ_tran]=="3 เฟส ขนาด 2000 KVA"){ echo "selected";} ?>> 3 เฟส ขนาด 2000 KVA</option>
                                    </select>
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
                                    <div class="form-group">
                                        <select id="equ_air" class="form-control" name="equ_air" disabled>
                                            <option value="12,000 บีทียู" <?php if($array[equ_air]=="12,000 บีทียู"){ echo "selected";} ?>>12,000 บีทียู</option>
                                            <option value="15,300 บีทียู" <?php if($array[equ_air]=="15,300 บีทียู"){ echo "selected";} ?>>15,300 บีทียู</option>
                                            <option value="18,000 บีทียู" <?php if($array[equ_air]=="18,000 บีทียู"){ echo "selected";} ?>>18,000 บีทียู</option>
                                            <option value="20,800 บีทียู" <?php if($array[equ_air]=="20,800 บีทียู"){ echo "selected";} ?>>20,800 บีทียู</option>
                                            <option value="22,800 บีทียู" <?php if($array[equ_air]=="22,800 บีทียู"){ echo "selected";} ?>>22,800 บีทียู</option>
                                            <option value="27,200 บีทียู" <?php if($array[equ_air]=="27,200 บีทียู"){ echo "selected";} ?>>27,200 บีทียู</option>
                                            <option value="32,800 บีทียู" <?php if($array[equ_air]=="32,800 บีทียู"){ echo "selected";} ?>>32,800 บีทียู</option>
                                            <option value="38,000 บีทียู" <?php if($array[equ_air]=="38,000 บีทียู"){ echo "selected";} ?>>38,000 บีทียู</option>

                                        </select>
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
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label>(5)พัดลม</label>
                                    <div class="form-group input-group">
                                        <input type="number" class="form-control" placeholder="กรุณากรอกข้อมูล" name="equ_fan" value="<?= $array[equ_fan] ?>" readonly>
                                        <span class="input-group-addon">เครื่อง</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label>(6) มิเตอร์</label>
                                    <div class="form-group">
                                        <select id="me_id" class="form-control" name="me_id" disabled>
                                            <option value=""><-- เลือกขนาดหม้อแปลง --></option>
                                            <?php
                                            $sqlmeter = "SELECT * FROM tb_meter where me_type='".$array['me_id']."' ";
                                            $querrymeter = mysql_query($sqlmeter);
                                            while ($arraymeter = mysql_fetch_array($querrymeter)) {
                                                ?>
                                                <option value="<?= $arraymeter['me_id']; ?>" selected><?= $arraymeter['me_name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>จำนวน</label>
                                    <div class="form-group input-group">
                                        <input type="number" class="form-control" name="equ_meter_unit" value="<?= $array[equ_meter_unit] ?>"readonly>
                                        <span class="input-group-addon">ตัว</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-8">
                                    <label>(7)อื่นๆ ระบุ</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="equ_detail" value="<?= $array[equ_detail] ?>" readonly> 
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
