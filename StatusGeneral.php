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
function Dateim($mydate){
    $d=split("-",$mydate);
    $mydate=$d[2]."/".$d[1]."/".($d[0]+543);
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
<?php include "header.php";?>

<?php
    include"sidebar.php"; 
?>
    <div id="page-wrapper">
        <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">อนุมัติคำร้องทั่วไป</h2>
                </div>
            <div class="panel-body">
                <div class="col-sm-12">
            <div class="col-sm-4">
                <form name="frmSearch" method="POST">
                    <div class="form-group input-group">
                        <input type="search" name="search" class="form-control" placeholder="ค้นหาใบคำร้อง">
                        <span class="input-group-btn">
                            <button class="btn btn-info" type="submit" style="height:34px;"><i class="fa fa-search"></i></button>
                        </span>
                    </div> 
                </form>
            </div>

            <div class="col-sm-12">
                <div class="table-responsive">
                    <table width="100%" class="table table-bordered table-hover">
                        <thead>               
                            <tr>
                                <th class=" text-center" >ลำดับ</th>
                                <th class=" text-center" >รหัสใบคำร้อง</th>
                                <th class=" text-center" >วันที่บันทึก</th>
                                <th class=" text-center" >รายการ</th>
                                <th class=" text-center" >ลูกค้า</th>
                                <th class=" text-center" >โทรศัพท์</th>
                                <th class=" text-center">จัดการข้อมูล</th>
                            </tr> 
                        </thead>
                            <tbody>
                            <?php
                                $n=0;
                                $sql="select * from tb_general where rg_id like '%".$_POST[search]."%' and rg_status='0' order by rg_id desc";
                                $result=mysql_db_query($dbname,$sql);
                                    if(mysql_num_rows($result)>0){
                                        while($array=mysql_fetch_array($result)){
                                            $page++;
                                            $sqlcus="select * from tb_customer where cus_id='".$array[cus_id]."'";
                                            $resultcus=mysql_db_query($dbname,$sqlcus);
                                            $arraycus=mysql_fetch_array($resultcus);
                                            
                                            if($array[rg_want_type]==0){
                                                $want="ขอรับเงินประกันการใช้ไฟฟ้าคืน";
                                            }elseif($array[rg_want_type]==1){
                                                $want="ขอรับเงินประกันคาปาซิเตอร์คืน";
                                            }elseif($array[rg_want_type]==2){
                                                $want="ขอรับเงินประกันหม้อแปลงไฟฟ้าคืน";
                                            }elseif($array[rg_want_type]==3){
                                                $want="ขอรับค่าขยายเขตระบบจำหน่ายไฟฟ้าคืน";
                                            }elseif($array[rg_want_type]==4){
                                                $want="ขอใช้บริการพิมพ์โฆษณาหลังใบแจ้งหนี้";
                                            }elseif($array[rg_want_type]==5){
                                                $want="ขอชำระเงินค่าไฟฟ้าโดยหักจากบัญชีเงินฝากธนาคาร";
                                            }elseif($array[rg_want_type]==6){
                                                $want="ขอเช่าพื้นที่โฆษณา";
                                            }elseif($array[rg_want_type]==7){
                                                $want="ขอเช่าพาดสายโทรนาคม";
                                            }elseif($array[rg_want_type]==8){
                                                $want="ขอเช่าสาย fiber optic";
                                            }elseif($array[rg_want_type]==9){
                                                $want="ขอเช่าที่ดิน";
                                            }elseif($array[rg_want_type]==10){
                                                $want="ขอซื้อที่ดิน";
                                            }elseif($array[rg_want_type]==11){
                                                $want="ขอใช้ไฟฟ้าที่ กฟภ. สนับสนุน";
                                            }else{
                                               $want=$array[rg_want_other]; 
                                            }
                            ?>	
                                    <tr>
                                        <td class="text-center"><?=$page?></td>
                                            <td class=" text-center"><?=$array[rg_id]?></td>
                                            <td class=" text-center"><?= Dateim($array[rg_date]);?></td>
                                            <td class=" text-center"><?=$want?></td>
                                            <td class="text-center"><?=$arraycus[cus_name]?></td>
                                            <td class="text-center"><?=$arraycus[cus_tel]?></td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <a class="btn btn-default" href="StatusGeneral_detail.php?id=<?=$array[rg_id]?>" title="ดูรายละเอียด"><i class="fa fa-check"> อนุมัติคำร้อง</i></a>
                                                    <a class="btn btn-danger" onclick="return confirm('คุณต้องการยกเลิกใบคำร้องนี่ ?')" href="StatusGeneral_save.php?id=<?=$array[rg_id]?>&mode=del" ><i class="fa fa-times"> ยกเลิกคำร้อง</i></a>
                                                </div>
                                            </td>
                                    </tr>
                                    <?php
                                                    }
                                            }else{	
                                    ?>				  
                                    <tr><td colspan="7" align="center">ไม่พบข้อมูล</td></tr>
                                    <?
                                            }
                                    ?>	
                            </tbody>
                    </table>
                </div>
            </div>  					
        </div>

				
            </div>
        </div>

</div>
</body>

</html>
