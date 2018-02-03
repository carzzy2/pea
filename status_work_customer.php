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
        function Dateim($mydate) {
            $d = split("-", $mydate);
            $mydate = $d[2] . "/" . $d[1] . "/" . ($d[0] + 543);
            return "$mydate";
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
<?php include "header_cus.php";?>
</nav>
<div class="container">
    <h2><i class="fa fa-eye"></i> ผลการค้นหาคำร้องขอใช้ไฟฟ้าเลขที่ <?= $_SESSION[loginid] ?></h2>
    <hr class="star-primary">
    <div class="col-md-12">
        <div class="table-responsive col-md-12">
            <table  class="table table-striped table-bordered  ">
                <thead>               
                    <tr>
                        <th class=" text-center" >วันที่บันทึกคำร้อง</th>
                        <th class=" text-center" >พนักงานผู้ดำเนินการ</th>
                        <th class=" text-center" >สถานะการทำงาน</th>
                    </tr> 
                </thead>
                <tbody>
                    <?php
                    $sql = "select * from tb_electricity,tb_user where re_id='" . $_SESSION[loginid] . "' and tb_electricity.user_id = tb_user.user_id  order by re_id desc ";
                    $result = mysql_db_query($dbname, $sql);
                    if (mysql_num_rows($result) > 0) {
                        while ($array = mysql_fetch_array($result)) {
                            if($array[re_status]==0){
                                $label="ยังไม่ได้สำรวจ";
                                $status="#848480";
                            }elseif($array[re_status]==1){
                               $status="#5bc0de";
                               $label="ผ่านการสำรวจแล้ว";
                            }elseif($array[re_status]==2){
                               $status="#F78234";
                               $label="ชำระค่าธรรมเนียมแล้ว";
                            }elseif($array[re_status]==3){
                               $status="#99cc00";
                               $label="บันทึกการปฎิบัติงานแล้ว";
                            }elseif($array[re_status]==4){
                               $status="#16DD87";
                               $label="ไม่ผ่านการตรวจสอบมาตรฐาน,รอแก้ไข";
                            }elseif($array[re_status]==5){
                               $status="#751C90";
                               $label="ไม่ผ่านการตรวจสอบมาตรฐาน,รอตรวจสอบใหม่";
                            }elseif($array[re_status]==6){
                               $status="#2E9AFE";
                               $label="เสร็จสิ้น";
                            }elseif($array[re_status]==9){
                               $status="#d9534f";
                               $label="ไม่ผ่านการสำรวจ";
                            }
                            $first=$array[user_name];
                            $last=$array[user_last];
                            $tel=$array[user_tel];
                            if($array[re_want_type]=="1" or $array[re_want_type]=="5" or $array[re_want_type]=="6" or $array[re_want_type]=="7" or $array[re_want_type]=="8" or $array[re_want_type]=="9" or $array[re_want_type]=="14"){
                            ?>	
                            <tr>
                                <td class="text-center"><?= Dateim($array['re_date']); ?></td>
                                <td class="text-center"><?= $array['user_name'] ?> <?= $array['user_last'] ?></td>
                                <td class="text-center"><?=$label?></td>
                            </tr>
                            <?php
                            }else{ ?>
                                <tr>
                                    <td class="text-center"><?= Dateim($array['re_date']); ?></td>
                                    <td class="text-center"><?= $array['user_name'] ?> <?= $array['user_last'] ?></td>
                                    <td class="text-center"><?=$label?></td>
                                </tr>
                            <?php
                            }
                        }
                    } 
                    ?>				                           
                    
                </tbody>
            </table>
            <?php
            $sqlv = "select * from tb_logview order by log_date desc limit 1 ";
            $resultv = mysql_db_query($dbname, $sqlv);
            $arrayv = mysql_fetch_array($resultv);
            if (mysql_num_rows($resultv) > 0) {
            ?>
            <div class="col-md-12">
                <h4>
                    <small>เข้าดูล่าสุด เมื่อ <?=$arrayv['log_date']?></small>
                </h4>
            </div>
            <?php
            }
            ?>
            <div class="col-md-12">
                <label style="color: red;">* หากมีปัญหากรุณาติดต่อ <?=$tel?> คุณ<?=$first?> <?=$last?> (ผู้บันทึกข้อมูลใบคำร้องขอใช้ไฟฟ้า)</label>
            </div>
        </div>
    </div>  
</div>
<?php
$new_id =mysql_result(mysql_query("Select Max(substr(log_id,-4))+1 as MaxID from tb_logview"),0,"MaxID" );
if($new_id==''){ // ถ้าได้เป็นค่าว่าง หรือ null ก็แสดงว่ายังไม่มีข้อมูลในฐานข้อมูล
$logid="LOG00001";
}else{
$logid="LOG".sprintf("%05d",$new_id);//ถ้าไม่ใช่ค่าว่าง
}
 $sql="insert into tb_logview(log_id,log_date,re_id) values('".$logid."',NOW(),'".$_SESSION[loginid]."')";
mysql_query($sql);
?>
</body>

</html>
