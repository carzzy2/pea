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
    $sql_edit="select * from tb_general,tb_customer where rg_id='".$id."' and tb_general.cus_id=tb_customer.cus_id";
    $result_edit=mysql_db_query($dbname,$sql_edit);
    $array_edit=mysql_fetch_array($result_edit);
    if($array_edit['cus_first']=="0"){ 
        $first="นาย";
    }elseif($array_edit['cus_first']=="1"){
        $first="นาง";
    }elseif($array_edit['cus_first']=="2"){
        $first="นางสาว";
    }
   function Dateim($mydate) {
        $d = split("-", $mydate);
        $mydate = $d[2] . "/" . $d[1] . "/" . ($d[0] + 543);
        return "$mydate";
    }
    
    if($array_edit[rg_want_type]==0){
    $want="ขอรับเงินประกันการใช้ไฟฟ้าคืน";
    }elseif($array_edit[rg_want_type]==1){
    $want="ขอรับเงินประกันคาปาซิเตอร์คืน";
    }elseif($array_edit[rg_want_type]==2){
    $want="ขอรับเงินประกันหม้อแปลงไฟฟ้าคืน";
    }elseif($array_edit[rg_want_type]==3){
    $want="ขอรับค่าขยายเขตระบบจำหน่ายไฟฟ้าคืน";
    }elseif($array_edit[rg_want_type]==4){
    $want="ขอใช้บริการพิมพ์โฆษณาหลังใบแจ้งหนี้";
    }elseif($array_edit[rg_want_type]==5){
    $want="ขอชำระเงินค่าไฟฟ้าโดยหักจากบัญชีเงินฝากธนาคาร";
    }elseif($array_edit[rg_want_type]==6){
    $want="ขอเช่าพื้นที่โฆษณา";
    }elseif($array_edit[rg_want_type]==7){
    $want="ขอเช่าพาดสายโทรนาคม";
    }elseif($array_edit[rg_want_type]==8){
    $want="ขอเช่าสาย fiber optic";
    }elseif($array_edit[rg_want_type]==9){
    $want="ขอเช่าที่ดิน";
    }elseif($array_edit[rg_want_type]==10){
    $want="ขอซื้อที่ดิน";
    }elseif($array_edit[rg_want_type]==11){
    $want="ขอใช้ไฟฟ้าที่ กฟภ. สนับสนุน";
    }else{
    $want=$array[rg_want_other]; 
    }

    $sql_user="select * from tb_user where user_id='".$array_edit[user_id]."'";
    $result_user=mysql_db_query($dbname,$sql_user);
    $array_user=mysql_fetch_array($result_user);
    $read="";
?>
    <div id="page-wrapper">
        <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">บันทึกใบคำร้องทั่วไปเลขที่ <?=$array_edit[rg_id]?></h2>
                </div>
            <div class="panel-body">
                <div class="row">
            <form method="post" action="StatusGeneral_save.php" id="form" >
                <div class="col-sm-12 well">
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>เลขที่คำร้อง</label>
                        <input class="form-control" autocomplete=off  name="rg_id" type="text" id="rg_id" value="<?=$array_edit[rg_id]?>" size="30" readonly/>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>กฟฟ(สาขา).</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_branch" type="text" id="rg_branch" value="<?=$array_edit[rg_branch]?>" readonly>	
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>เจ้าหน้าที่ผู้รับคำร้อง</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="user_id" type="text" id="user_id" value="<?=$array_user[user_name]?> <?=$array_user[user_last]?>" readonly/>	
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>วัน/เดือน/ปี</label>
                            <input class="form-control" placeholder="กรุณากรอกข้อมูล" name="rg_date" type="text" id="rg_date" value="<?= Dateim($array_edit[rg_date]);?>"  readonly/>	
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                        <label>มีความประสงค์</label>
                            <input class="form-control"  name="rg_want_other" type="text" id="rg_want_other" value="<?=$want?>" readonly/>
                        </div>
                        <?php
                        if($array_edit[rg_want_type]=='0' or  $array_edit[rg_want_type]=='1' or  $array_edit[rg_want_type]=='2' or $array_edit[rg_want_type]=='3'){
                            if($array_edit[rg_want_type]=='0'){
                               $sql_f="select * from tb_electricity where cus_id='".$array_edit[cus_id]."' and re_want_type='0' and re_status='6' ";
                                $result_f=mysql_db_query($dbname,$sql_f);
                                $array_f=mysql_fetch_array($result_f);
                                
                                $sql_f2="select * from tb_equipment where re_id='".$array_f[re_id]."' and equ_status=0";
                                $result_f2=mysql_db_query($dbname,$sql_f2);
                                $array_f2=mysql_fetch_array($result_f2);

                                $sql_f3="select * from tb_meter where me_id='".$array_f2[me_id]."'";
                                $result_f3=mysql_db_query($dbname,$sql_f3);
                                $array_f3=mysql_fetch_array($result_f3);
                                $read="readonly";
                                $sql_f4="select * from tb_fee where re_id='".$array_f[re_id]."'";
                                $result_f4=mysql_db_query($dbname,$sql_f4);
                                $array_f4=mysql_fetch_array($result_f4);
                            }
                            
                        ?>
                        <div class="form-group col-sm-3">
                        <label>จำนวนทั้งหมด(บาท)</label>
                        <input class="form-control"  name="rg_money" type="number" id="rg_money"  min="0" value="<?=$array_f4[fee_price]?>" <?=$read?>>
                        </div>
                        <div class="form-group col-sm-3">
                        <label>จำนวนเงินค่าประกัน(บาท)</label>
                        <input class="form-control"  name="rg_money" type="number" id="rg_money"  min="0" value="<?=$array_f3[me_insure]?>" <?=$read?>>
                        </div>
                        
                        <?php
                        }
                        ?>
                    </div>
                    <center>
                        <?php
                        if($_GET['mode']!="view"){
                        ?>
                        <input name="ok" type="submit" value="อนุมัติใบคำร้อง" id="calculatertool" class="btn btn-success" >
                        <input name="txtid" type="hidden" value="<?=$id?>" />
                        <input name="rg_want_type" type="hidden" value="<?=$array_edit[rg_want_type]?>" />
                        <?php
                        }
                        ?>
                        <a class="btn btn-info" onclick="location.href='StatusGeneral.php'">ย้อนกลับ</a>
                    </center>
                </div>
            </form> 
        </div>

				
            </div>
        </div>

</div>
</body>

</html>
