
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
    <div id="page-wrapper">
        <div class="col-sm-12 ">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">คำร้องทั่วไป</h2>
                </div>
            <div class="panel-body">
        <div class="row">
            <form name="frmSearch" method="POST" >
                <div class="col-sm-3">
                    <select id="type" class="form-control" name="type" required>
                        <option value="1" <?php if($_POST['type']=="1"){ echo "selected=selected"; }?>>รหัสบัตรประชาชน</option>
                        <option value="2" <?php if($_POST['type']=="2"){ echo "selected=selected"; }?>>ชื่อ-นามสกุล</option>
                    </select>
                </div> 
                <div class="col-sm-5">
                        <div class="form-group input-group">
                            <input type="search" name="search" class="form-control" placeholder="ค้นหาผู้ใช้ไฟฟ้า">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="submit" style="height:34px;"><i class="fa fa-search"> ค้นหา</i></button>
                            </span>
                        </div> 
                </div>
                <div class="col-sm-1">
                    <p align="center" >หรือ </p>
                </div>
                <div class="col-sm-3">
                    <div class="form-group input-group">
                            <a href="RequestGeneral_part1.php"><input type="button" value="เพื่มผู้ใช้บริการใหม่" class="btn  btn-info"></a>
                        </div>
                </div>
            </form>
        </div>

                <div class="table-responsive">
                    <table width="100%" class="table table-bordered table-hover">
                        <thead>               
                            <tr>
                                <th class=" text-center" >ลำดับ</th>
                                <th class=" text-center" >รหัสประชาชน</th>
                                <th class=" text-center" >ชื่อ-นามสกุล</th>
                                <th class=" text-center" >ที่อยู่</th>
                                <th class=" text-center" >หมายเลขผู้ใช้ไฟฟ้า</th>
                                <th class=" text-center" >เบอร์โทรศัพท์</th>
                                <th class=" text-center">จัดการข้อมูล</th>
                            </tr> 
                        </thead>
                            <tbody>
                            <?php
                                $n=0;
                                if($_POST['type']=="0"){
                                    $sql="select * from tb_customer where cus_code like '%".$_POST[search]."%' order by cus_id";
                                }elseif($_POST['type']=="1"){
                                    $sql="select * from tb_customer where cus_id like '%".$_POST[search]."%' order by cus_id";
                                }else{
                                   $sql="select * from tb_customer where cus_name like '%".$_POST[search]."%' order by cus_id"; 
                                }
                                $result=mysql_db_query($dbname,$sql);
                                if($_POST['search']==""){
                                ?>
                                <tr><td colspan="7" align="center">ไม่พบข้อมูล</td></tr>
                                <?php
                                }else{
                                    if(mysql_num_rows($result)<1){
                                        
                                ?>
                                <tr><td colspan="7" align="center">ไม่พบข้อมูล</td></tr>
                                <?php
                                }else{    
                                ?>
                                <?php
                                    while($array=mysql_fetch_array($result)){
                                        $n++;
                                        if($array[cus_first]==0){
                                            $first="นาย";
                                        }elseif($array[cus_first]==1){
                                            $first="นาง";
                                        }else{
                                           $first="นางสาว"; 
                                        }
                                ?>	
                                    <tr>
                                        <td class="text-center"><?=$n?></td>
                                            <td><?=$array[cus_id]?></td>
                                            <td><?=$first?><?=$array[cus_name]?></td>
                                            <td width="300px">บ้านเลขที่ <?=$array[cus_number]?> หมู่บ้าน/อาคาร <?=$array[cus_village]?> ซ. <?=$array[cus_alleyway]?> ถ. <?=$array[cus_road]?> ม. <?=$array[cus_vilno]?> ต. <?=$array[cus_district]?> อ. <?=$array[cus_canton]?> จ. <?=$array[cus_province]?> <?=$array[cus_post]?> 
                                            </td>
                                            <td class="text-center"><?=$array[cus_code]?></td>
                                            <td class="text-center"><?=$array[cus_tel]?></td>
                                            <td align="center">
                                                <a class="btn btn-default" href="RequestGeneral_part2.php?id=<?=$array[cus_id]?>" title="เลือก"><i class="fa fa-check-circle-o"> เลือก</i></a>
                                            </td>
                                    </tr>
                                    <?php
                                    }     	
                                    ?>				  
                                <?php
                                }
                                
                                }
                                ?>	
                            </tbody>
                    </table>
                </div>
                        <a class="btn btn-danger" onclick="location.href='requestGeneral_show.php'"> ยกเลิก</a>	
            </div>				
        </div>
        </div>
    </div>

</body>

</html>
