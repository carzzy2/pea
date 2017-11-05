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
    <h2>ผลการค้นหาคำร้องขอใช้ไฟฟ้าเลขที่ <?= $_SESSION[loginid] ?></h2>
    <hr class="star-primary">
    <div class="col-md-12">
        <div class="table-responsive col-md-12">
            <table  class="table table-striped table-bordered  ">
                <thead>               
                    <tr>
                        <th class=" text-center" >วันที่</th>
                        <th class=" text-center" >พนักงานผู้ดำเนินการ</th>
                        <th class=" text-center" >สถานะการทำงาน</th>
                        <th class=" text-center" >หมายเหตุ</th>
                    </tr> 
                </thead>
                <tbody>
                    <?php
                    $sql = "select * from tb_electricity,tb_user where re_id='" . $_SESSION[loginid] . "' and tb_electricity.user_id = tb_user.user_id  order by re_id desc ";
                    $result = mysql_db_query($dbname, $sql);
                    if (mysql_num_rows($result) > 0) {
                        while ($array = mysql_fetch_array($result)) {
                            $first=$array[user_name];
                            $last=$array[user_last];
                            $tel=$array[user_tel];
                            if($array[re_want_type]=="1" or $array[re_want_type]=="5" or $array[re_want_type]=="6" or $array[re_want_type]=="7" or $array[re_want_type]=="8" or $array[re_want_type]=="9" or $array[re_want_type]=="14"){
                            ?>	
                            <tr>
                                <td class="text-center"><?= Dateim($array['re_date']); ?></td>
                                <td class="text-center"><?= $array['user_name'] ?> <?= $array['user_last'] ?></td>
                                <td class="text-center">เสร็จสิ้น</td>
                                <td align="center"> - </td>
                            </tr>
                            <?php
                            }else{ ?>
                                <tr>
                                    <td class="text-center"><?= Dateim($array['re_date']); ?></td>
                                    <td class="text-center"><?= $array['user_name'] ?> <?= $array['user_last'] ?></td>
                                    <td class="text-center">ลงทะเบียน</td>
                                    <td align="center"> - </td>
                                </tr>
                            <?php
                            }
                        }
                    } 
                    ?>				                           
                    <?php
                    $sql2 = "select * from tb_equipment,tb_user where re_id='" . $_SESSION[loginid] . "' and tb_equipment.user_id=tb_user.user_id";
                    $result2 = mysql_db_query($dbname, $sql2);
                    if (mysql_num_rows($result2) > 0) {
                        while ($array2 = mysql_fetch_array($result2)) {
                            
                            if($array2[equ_status]==0){
                                $ee="สำรวจแล้ว";
                            }else{
                                $ee="ไม่ผ่านการสำรวจ";
                            }
                            if($array2['equ_detail']==""){
                                $detail="-";
                            }else{
                                $detail=$array2['equ_detail'];
                            }
                            ?>	
                            <tr>
                                <td class="text-center"><?= Dateim($array2['equ_date']); ?></td>
                                <td class="text-center"><?= $array2['user_name'] ?> <?= $array2['user_last'] ?></td>
                                <td class="text-center" ><?=$ee?></td>
                                <td><?= $detail ?></td>
                            </tr>
                            <?php
                        }
                    }
                        ?>				  
                </tbody>
            </table>
            <div class="col-md-12">
                <label style="color: red;">* หากมีปัญหากรุณาติดต่อ <?=$tel?> คุณ<?=$first?> <?=$last?> (ผู้บันทึกข้อมูลใบคำร้องขอใช้ไฟฟ้า)</label>
            </div>
        </div>
    </div>  
</div>
            
</body>

</html>
