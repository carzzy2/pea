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
        <div class="col-sm-12 ">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">ใบคำร้องทั่วไป</h2>
                </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-2">
                        <a href="RequestGeneral.php"><input type="button" value="เพิ่มข้อมูล" class="btn  btn-success"></a>
                    </div>
                    <div class="col-sm-4">
                        <form name="frmSearch" method="POST">
                            <div class="form-group input-group">
                                <input type="search" name="search" class="form-control" placeholder="ค้นหาข้อมูล">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="submit" style="height:34px;"><i class="fa fa-search"></i></button>
                                </span>
                            </div> 
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <span style="background-color: #848480; border-radius:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                        <span>ยังไม่อนุมัติ</span>
                        
                        <span style="background-color: #d9534f; border-radius:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                        <span>ยกเลิกใบคำร้อง</span>
                        
                        <span style="background-color: #F78234; border-radius:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                        <span>อนุมัติแล้ว</span>
                        
                        <span style="background-color: #2E9AFE; border-radius:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                        <span>เสร็จสิ้น</span>                     
                    </div>
                </div>
                
            <div class="col-sm-12">
                <div class="table-responsive">
                    <?php
                        $sql_all_rows="select * from tb_general order by rg_id";
                        $result_all_rows=mysql_db_query($dbname,$sql_all_rows);
                        $rows=mysql_num_rows($result_all_rows);
                        echo $row;
                        $total_page=ceil($rows/$limit);
                        if($_GET[start]==""){ $start="1"; }else{ $start=$_GET[start]; }
                    ?>	
                    <?php
                    for($i=1;$i<=$total_page;$i++){
                            if($start==$i){
                                    echo "<a href='RequestGeneral_show.php?start=".$i."&limit=".$limit."'><button class='btn btn-default '>".$i."</button></a>&nbsp;";
                            }else{
                                    echo "<a href='RequestGeneral_show.php?start=".$i."&limit=".$limit."' c><button class='btn btn-default active'>".$i."</button></a>&nbsp;";
                            }

                    }
                    ?> <br><br>
                    
                    <table width="100%" class="table table-bordered table-hover">
                        <thead>               
                            <tr>
                                <th class=" text-center" >ลำดับ</th>
                                <th class=" text-center" >รหัสใบคำร้อง</th>
                                <th class=" text-center" >วันที่บันทึก</th>
                                <th class=" text-center" >รายการ</th>
                                <th class=" text-center" >ลูกค้า</th>
                                <th class=" text-center" style="min-width: 150"  >สถานะ</th>
                                <th class=" text-center">จัดการข้อมูล</th>
                            </tr> 
                        </thead>
                            <tbody>
                            <?php
                                $n=0;
                                if($_GET[start]=="" || $_GET[start]=="1"){ 
                                        $page="0"; 
                                }else{
                                        $page=($_GET[start]-1)*$limit; 
                                }
                                $sql="select * from tb_general where rg_id like '%".$_POST[search]."%' order by rg_id desc limit $page,$limit ";
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
                                            if($array[rg_status]==0){
                                                $status="#848480";
                                                $label="ยังไม่อนุมัติ";
                                            }elseif($array[rg_status]==1){
                                               $status="#F78234";
                                               $label="อนุมัติแล้ว";
                                            }elseif($array[rg_status]==2){
                                               $status="#d9534f";
                                              $label="ยกเลิกใบคำร้อง";
                                            }elseif($array[rg_status]==3){
                                              $status="#2E9AFE";
                                               $label="เสร็จสิ้น";
                                            }
                            ?>	
                                    <tr>
                                        <td class="text-center"><?=$page?></td>
                                            <td class=" text-center"><?=$array[rg_id]?></td>
                                            <td class=" text-center"><?= Dateim($array[rg_date]);?></td>
                                            <td class=" text-center"><?=$want?></td>
                                            <td class="text-center"><?=$arraycus[cus_name]?></td>
                                            <td class="text-center"><div style="border-radius:10px; background-color: <?=$status?>; color: white;"><?=$label?></div></td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <a class="btn btn-default" href="RequestGeneral_detail.php?rg_id=<?=$array[rg_id]?>" >ดูรายละเอียด</a>
                                                </div>
                                            </td>
                                    </tr>
                                    <?php
                                        }
                                            }else{	
                                    ?>				  
                                    <tr><td colspan="8" align="center">ไม่พบข้อมูล</td></tr>
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
<?php
    session_unregister('ss_rg_branch');
    session_unregister('ss_cus_id');
    session_unregister('ss_cus_first');
    session_unregister('ss_cus_name');
    session_unregister('ss_cus_type');
    session_unregister('ss_cus_tax');
    session_unregister('ss_cus_code');
    session_unregister('ss_cus_homeid');
    session_unregister('ss_cus_number');
    session_unregister('ss_cus_village');
    session_unregister('ss_cus_room');
    session_unregister('ss_cus_floor');
    session_unregister('ss_cus_alley');
    session_unregister('ss_cus_alleyway');
    session_unregister('ss_cus_road');
    session_unregister('ss_cus_vilno');
    session_unregister('ss_cus_district');
    session_unregister('ss_cus_canton');
    session_unregister('ss_cus_province');
    session_unregister('ss_cus_post');
    session_unregister('ss_cus_tel');
    session_unregister('ss_cus_fax');
    session_unregister('ss_cus_road');
    session_unregister('ss_cus_email');
    
    session_unregister('ss_rg_place_type');
    session_unregister('ss_rg_place_other');
    session_unregister('ss_rg_place_name');
    session_unregister('ss_rg_place_homeid');
    session_unregister('ss_rg_place_number');
    session_unregister('ss_rg_place_village');
    session_unregister('ss_rg_place_room');
    session_unregister('ss_rg_place_floor');
    session_unregister('ss_rg_place_alley');
    session_unregister('ss_rg_place_alleyway');
    session_unregister('ss_cus_email');
    session_unregister('ss_rg_place_road');
    session_unregister('ss_rg_place_vilno');
    session_unregister('ss_rg_place_district');
    session_unregister('ss_rg_place_canton');
    session_unregister('ss_rg_place_province');
    session_unregister('ss_rg_place_post');
    session_unregister('ss_rg_place_tel');
    session_unregister('ss_rg_place_fax');
    session_unregister('ss_rg_place_road');
    session_unregister('ss_rg_place_email');
    session_unregister('ss_rg_place_service');
    
    session_unregister('ss_rg_contact_homeid');
    session_unregister('ss_rg_contact_number');
    session_unregister('ss_rg_contact_village');
    session_unregister('ss_rg_contact_room');
    session_unregister('ss_rg_contact_floor');
    session_unregister('ss_rg_contact_alley');
    session_unregister('ss_rg_contact_alleyway');
    session_unregister('ss_rg_contact_road');
    session_unregister('ss_rg_contact_vilno');
    session_unregister('ss_rg_contact_district');
    session_unregister('ss_rg_contact_canton');
    session_unregister('ss_rg_contact_province');
    session_unregister('ss_rg_contact_post');
    session_unregister('ss_rg_contact_tel');
    session_unregister('ss_rg_contact_fax');
    session_unregister('ss_rg_contact_road');
    session_unregister('ss_rg_contact_email');
    session_unregister('ss_rg_contact_service');
?>
</body>

</html>
