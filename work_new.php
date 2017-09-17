<?php
@session_start();
include "connect_db.php";
$ses_userid = $_SESSION[ses_userid];
$ses_username = $_SESSION[loginid];
if ($ses_userid <> session_id() or $ses_username == "") {
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
        $new_id = mysql_result(mysql_query("Select Max(substr(work_id,-4))+1 as MaxID from tb_work"), 0, "MaxID");
        if ($new_id == '') {
            $feeid = "150000000001";
        } else {
            $feeid = "15" . sprintf("%010d", $new_id);
        }
        ?>
        <div id="page-wrapper">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">บันทึกการปฎิบัติงาน</h2>
                </div>
                <div class="panel-body">
                    <form method="post" action="work_cal.php">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3 form-group">
                                    <label>รหัสการปฎิบัติงาน</label>
                                    <input class="form-control" autocomplete=off  name="fee_id" type="text" id="fee_id" value="<?= $feeid ?>" size="30" readonly/>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>วัน/เดือน/ปี</label>
                                    <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="re_date" type="text" id="re_date" value="<?= date("d/m/") . (date("Y") + 543) ?>"  readonly/>	
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>เลขที่คำร้องขอใช้ไฟฟ้า</label>
                                    <select id="re_id" class="form-control" name="re_id" OnChange="window.location = 'work_addreid?re_id=' + this.value;">
                                        <option value=""><-- เลือกเลขที่คำร้องขอใช้ไฟฟ้า --></option>
                                        <?php
                                        $strSQL = "SELECT * FROM tb_electricity where re_status='2' ORDER BY re_id ASC";
                                        $objQuery = mysql_query($strSQL);
                                        while ($objResult = mysql_fetch_array($objQuery)) {
                                            if ($_SESSION['ss_re_id'] == $objResult["re_id"]) {
                                                $sel = "selected";
                                            } else {
                                                $sel = "";
                                            }
                                            ?>
                                            <option value="<?= $objResult["re_id"]; ?>"<?php echo $sel; ?>><?= $objResult["re_id"]; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                            </div>
                            <?php
                            if ($_SESSION['ss_re_id'] != "") {
                                    $sql = "select * from tb_electricity ele,tb_customer cus where re_id='" . $_GET[item] . "' and ele.cus_id=cus.cus_id";
                                    $result = mysql_db_query($dbname, $sql);
                                    $array = mysql_fetch_array($result);
                                ?>
                            <div class="row">
                                <div class="col-sm-3 form-group">
                                    <label>เจ้าหน้าที่ปฎิบัติงาน</label>
                                    <select id="user_id" class="form-control" name="user_id" OnChange="window.location = 'work_add?user_id=' + this.value;">
                                        <option value=""><-- เลือกเจ้าหน้าที่ปฎิบัติงาน --></option>
                                        <?php
                                        $strSQL = "SELECT * FROM tb_user where user_pos='1' ";
                                        $objQuery = mysql_query($strSQL);
                                        while ($objResult = mysql_fetch_array($objQuery)) {
                                            ?>
                                            <option value="<?= $objResult['user_id']; ?>" ><?= $objResult['user_id']; ?> <?php echo $objResult['user_name']; ?> <?php echo $objResult['user_last']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                                <table  class="table table-bordered table-hover">
                                    <thead>               
                                        <tr>             
                                            <th class="text-center" width="150px">รหัสเจ้าหน้าที่</th>
                                            <th class="text-center">ชื่อเจ้าหน้าที่</th>
                                            <th class="text-center">หน้าที่</th>
                                            <th  class="text-center" width="200px">จัดการข้อมูล</th>
                                        </tr> 
                                    </thead>
		<tbody>
<?php
	if(count($_SESSION['ss_user_id'])==0){
		$enable="disabled";
		$title="กรุณาเลือกเจ้าหน้าที่";
?>		
                     <tr>
                        <td colspan="4" align="center" >กรุณาเลือกเจ้าหน้าที่</td>
                    </tr>
<?php
	}else{
		for($i=0;$i<count($_SESSION['ss_user_id']);$i++){
			$sql_user="select * from tb_user where user_id='".$_SESSION['ss_user_id'][$i]."'";
			$result_user=mysql_db_query($dbname,$sql_user);
			$array_user=mysql_fetch_array($result_user);
			$title="คลิก";
?>		
            <tr>
                <td class="text-center"><?=$_SESSION['ss_user_id'][$i]?></td>
                <td>คุณ<?=$array_user[user_name]?> <?=$array_user[user_last]?></td>
                <td><textarea name="work_detail[]" cols="20" class="form-control" placeholder="ระบุหน้าที่" required><?=$_SESSION['ss_user_detail'][$i]?></textarea></td>
                <td align="center"><a class="btn btn-danger"  title="ลบ" href="work_cal.php?tdel=<?=$array_user[user_id]?>">ลบออก</a>
            </tr>
<?php
		}
?>
	
<?php
}
?>	
                </tbody>
                                </table>
                            <?php } ?>
                            <center>
                                <input type="hidden" name="fee_price" value="<?=$total?>" >
                                <a class="btn btn-info" onclick="location.href = 'work_show.php'"> ย้อนกลับ</a>
                                <?php
                            if ($_SESSION['ss_re_id'] != "") {
                                ?>
                                <input class="btn btn-success" name="finish" type="submit" id="finish" <?=$enable?> title="<?=$title?>" value="บันทึก" >             
                            <?php } ?>
                            </center>
                        </div>
                    </form> 
                </div>


            </div>
        </div>
    </body>

</html>
