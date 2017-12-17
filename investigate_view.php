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
$sql="select * from tb_electricity,tb_user where tb_electricity.re_id='".$_GET[id]."' and tb_electricity.user_id=tb_user.user_id ";
$result=mysql_db_query($dbname,$sql);
$array2=mysql_fetch_array($result);

$limit=2;
?>
    <div id="page-wrapper">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="panel-title">รายละเอียดการตรวจสอบมาตรฐานการดำเนินงานใบคำร้องขอใช้ไฟฟ้าเลขที่ <?=$_GET[id]?> </h2>
            </div>
            <div class="panel-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-3 form-group">
                                <label>เลขที่คำร้อง</label>
                                <input class="form-control" autocomplete=off  name="re_id" type="text" id="re_id" value="<?= $array2[re_id] ?>" size="30" readonly/>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>กฟฟ(สาขา).</label>
                                <input  type="text" class="form-control"  value="<?= $array2['re_branch'] ?>" readonly>		
                            </div>
                            
                            <div class="col-sm-3 form-group">
                                <label>วัน/เดือน/ปี</label>
                                <input class="form-control" name="re_date" type="text" value="<?= Dateim($array2[re_date]);?>"  readonly/>	
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>เจ้าหน้าที่ที่สำรวจ</label>
                                <input class="form-control" name="re_date" type="text" value="<?=$array2[user_name];?> <?=$array2[user_last];?>"  readonly/>
                            </div>
                        </div>
                        <?php
                        $sql_all_rows="select * from tb_investigate where re_id='".$_GET[id]."' ";
                        $result_all_rows=mysql_db_query($dbname,$sql_all_rows);
                        $rows=mysql_num_rows($result_all_rows);
                        echo $row;
                        $total_page=ceil($rows/$limit);
                        if($_GET[start]==""){
                            $start="1"; 
                            
                        }else{ 
                            $start=$_GET[start]; 
                            
                        }
                    ?>	
                        <?php
                        if($_GET[time]==NULL){
                            $n=1;
                        }else{
                            $n=$_GET[time];
                        }
                        
                            if($_GET[start]=="" || $_GET[start]=="1"){ 
                                        $page="0"; 
                                }else{
                                        $page=($_GET[start]-1)*$limit; 
                                }
                            $sql_eq="select * from tb_investigate where re_id='".$_GET[id]."'  order by ig_id asc  limit $page,$limit";
                            $result_eq=mysql_db_query($dbname,$sql_eq);
                            if (mysql_num_rows($result_eq) == 0) {
                                ?>
                        <div class="alert alert-info">
                            <strong>เลขที่ใบคำร้องขอใช้ไฟฟ้านี่ ไม่มีการตรวจสอบมาตรฐาน</strong> 
                          </div>
                        <?php
                            }else{
                            while ($array = mysql_fetch_array($result_eq)) {
                                $page++;
                               echo "<label>การตรวจสอบครั้งที่".$page."</label>";
                                if($array[ig_install]==0){
                                    $panel="success";
                                    $head="ผ่านการตรวจสอบ";
                                }else if($array[ig_install]==2){
                                     $panel="warning";
                                     $head="ไม่เรียบร้อยเนื่องจาก";
                                }else if($array[ig_install]==3){
                                     $panel="danger";
                                     $head="ไม่ผ่านการตรวจสอบ";
                                }
                        ?>
                        <br>
                        <div class="panel panel-<?=$panel?>">
                            <div class="panel-heading clearfix">
                                <h2 class="panel-title pull-left" style="padding-top: 7.5px;"><?=$head?> <?=$array[ig_install_other]?> วันที่ <?=Dateim($array[ig_date])?></h2> 
                                <div class="btn-group pull-right">
                                    <a href="investigate_print.php?id=<?=$array['ig_id']?>" target="_blank" class="btn btn-default btn-sm">Print</a>
                                    
                                  </div>
                            </div>
                            <div class="panel-body">
                                 <form method="post" action="investigate_save.php" class="form-inline">
                        <div class="col-sm-12">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="form-group">
                                            <label>รายงานและความเห็นของผู้ตรวจสอบ</label>
                                        </div>
                                    </div>    
                                    <div class="row">
                                        <div class="form-group ">
                                            <label>1. สายแม่แรงต่ำ ขนาด</label>
                                            <div class="form-group input-group">
                                                <input type="text" class="form-control" name="ig_lowtension" value="<?=$array['ig_lowtension']?>"  readonly>
                                                <span class="input-group-addon">ตร.มม</span>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label>จำนวน</label>
                                            <div class="form-group input-group">
                                                <input type="number" class="form-control" name="ig_lowtension_amount" min="0" value="<?=$array[ig_lowtension]?>"  readonly>
                                                <span class="input-group-addon">เฟส</span>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                            <div class="form-group input-group">
                                                <input type="number" class="form-control" name="ig_lowtension_line" min="0" value="<?=$array['ig_lowtension']?>" readonly>
                                                <span class="input-group-addon">สาย</span>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group ">
                                            <label>2. จ่ายไฟจากสถานไฟฟ้าย่อย</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ig_power" value="<?=$array['ig_lowtension']?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ฟีดเดอร์แรงสูง</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ig_power_speed"  value="<?=$array['ig_lowtension']?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ปีจัดซื้อ(ตาม มป.5)</label>
                                            <div class="form-group">
                                                <select id="equ_tran" class="form-control" name="ig_power_year" disabled>
                                                    <option value=""><-- เลือกปี --></option>
                                                    <option value="2560"<?php if($array[ig_power_year]=="2560"){ echo "selected";} ?>>2560</option>
                                                    <option value="2559" <?php if($array[ig_power_year]=="2559"){ echo "selected";} ?>>2559</option>
                                                    <option value="2558" <?php if($array[ig_power_year]=="2558"){ echo "selected";} ?>>2558</option>
                                                    <option value="2557" <?php if($array[ig_power_year]=="2557"){ echo "selected";} ?>>2557</option>
                                                    <option value="2556" <?php if($array[ig_power_year]=="2556"){ echo "selected";} ?>>2556</option>
                                                    <option value="2555" <?php if($array[ig_power_year]=="2555"){ echo "selected";} ?>>2555</option>
                                                    <option value="2554" <?php if($array[ig_power_year]=="2554"){ echo "selected";} ?>>2554</option>
                                                    <option value="2553" <?php if($array[ig_power_year]=="2553"){ echo "selected";} ?>>2553</option>
                                                    <option value="2552" <?php if($array[ig_power_year]=="2552"){ echo "selected";} ?>>2552</option>
                                                    <option value="2551" <?php if($array[ig_power_year]=="2551"){ echo "selected";} ?>>2551</option>
                                                    <option value="2550" <?php if($array[ig_power_year]=="2550"){ echo "selected";} ?>>2550</option>
                                                </select>
                                            </div><input type="hidden"  name="ig_power_year" value="<?=$array[ig_power_year]?>" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="radio">
                                                <label><input name="ig_lowpower" size="30" type="radio" value="1" id="ig_lowpower1" <?php if($array[ig_lowpower]=="1"){ echo "checked";} ?> disabled>ฟิดเดอร์แรงต่ำ</label>
                                                <label><input name="ig_lowpower" size="30" type="radio" value="2" id="ig_lowpower2" <?php if($array[ig_lowpower]=="2"){ echo "checked";} ?> disabled>เฟสแรงต่ำ</label>
                                            </div><input type="hidden"  name="ig_lowpower" value="<?=$array[ig_lowpower]?>" >
                                        </div>
                                        <div class="form-group ">
                                            <label>ชนิดของหม้อแปลง</label>
                                            <div class="form-group ">
                                                <input type="text" class="form-control"  name="ig_lowpower_type" value="<?=$array['ig_lowtension']?>" readonly>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label>หมายเลขหม้อแปลง</label>
                                            <div class="form-group ">
                                                <input type="text" class="form-control"  name="ig_lowpower_number" value="<?=$array['ig_lowpower_number']?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>หม้อแปลงขนาด</label>
                                            <div class="form-group ">
                                                <input type="text" class="form-control" value="<?=$array['ig_outlet']?>" name="ig_outlet"  readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group">
                                            <label>3.ความเห็นของผู้ตรวจสอบ</label>
                                        </div>
                                    </div>   <br> 
                                    <div class="row">
                                        <div class="form-group">
                                            <label >ประเภทกิจการ</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ig_bstype" value="<?=$array['ig_bstype']?>"  readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group">
                                            <label >ติดตั้งมิเตอร์ขนาด</label>
                                            <div class="form-group input-group">
                                                <input type="text" class="form-control" name="ig_meter"  value="<?=$array['ig_bstype']?>" readonly>
                                                <span class="input-group-addon">แอมป์</span>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label >เฟส</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ig_meter_phase" value="<?=$array['ig_bstype']?>"  readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label >โวลท์</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ig_meter_volt"  value="<?=$array['ig_bstype']?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                   
                                        <div class="form-group">
                                            <label >สายคิดค่าไฟฟ้าประเภท</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ig_linetype"  value="<?=$array['ig_bstype']?>" readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label >แรงดัน</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ig_linetype_pressure" value="<?=$array['ig_bstype']?>"  readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label >โวลท์</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ig_linetype_volt"  value="<?=$array['ig_bstype']?>" readonly>
                                            </div>
                                        </div>
                                         
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group">
                                            <label >ติดตั้งซีทีขนาด</label>
                                            <div class="form-group ">
                                                <input type="text" class="form-control" name="ig_ct"  value="<?=$array['ig_bstype']?>" readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label >วีทีขนาด</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ig_vt" value="<?=$array['ig_bstype']?>"  readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label >เควาร์ขนาด</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ig_kwa" value="<?=$array['ig_bstype']?>"  readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group">
                                            <label >หมายเลข PEA. มิเตอร์ก่อนหน้า(สายการจดหน่วยเดียวกัน)</label>
                                            <div class="form-group ">
                                                <input type="text" class="form-control" name="ig_number_bf"  value="<?=$array['ig_bstype']?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group">
                                            <label >หมายเลข PEA. มิเตอร์ถัดไป(สายการจดหน่วยเดียวกัน)</label>
                                            <div class="form-group ">
                                                <input type="text" class="form-control" name="ig_number_af"  value="<?=$array['ig_bstype']?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group">
                                            <label >สายการจดหน่วย</label>
                                            <div class="form-group ">
                                                <input type="text" class="form-control" name="ig_linepoint" value="<?=$array['ig_bstype']?>"  readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label >หมายเลข PEA.มิเตอร์</label>
                                            <div class="form-group ">
                                                <input type="text" class="form-control" name="ig_linenumber"  value="<?=$array['ig_bstype']?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <div class="radio">
                                                <label><input name="ig_install" size="30" type="radio" value="1" <?php if($array[ig_install]=="1"){ echo "checked";} ?> disabled>เรียบร้อยถูกต้องตามมาตรฐาน</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="radio">
                                                <label><input name="ig_install" size="30" type="radio" value="2" <?php if($array[ig_install]=="2"){ echo "checked";} ?> disabled>ไม่เรียบร้อย ควรแก้ไขเนื่องจาก</label>
                                            </div>
                                            <div class="form-group ">
                                                <input type="text" class="form-control"  name="ig_install_other1"value="<?=$array['ig_install_other']?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="radio">
                                                <label><input name="ig_install" size="30" type="radio" value="3" <?php if($array[ig_install]=="3"){ echo "checked";} ?> disabled>นัดตรวจสอบใหม่วันที่</label>
                                                <div class="form-group ">
                                                    <input type="date" class="form-control"  name="ig_install_other2" value="<?=$array['ig_install_other']?>" readonly>
                                                </div>
                                            </div>
                  
                                        </div>
                                    </div>

                                </div>
                                
                            </div>
                        </div>
                    </form> 
                        </div>
                            </div>
                        <?php
                    }
                        }
                        ?>
                        <center>

                        <?php
                    for($i=1;$i<=$total_page;$i++){
                            if($i==$start-1){
                                    echo "<a href='investigate_view.php?start=".$i."&limit=".$limit."&id=".$_GET[id]."'><button class='btn btn-default '><i class='fa fa-arrow-left'> ย้อนกลับ</i></button></a>&nbsp;";
                            }
                            
                    }
                    ?>

                            <a class="btn btn-info" onclick="location.href='investigate_show.php'"> <i class='fa fa-times'> กลับหน้าแรก</i></a>                     
                         <?php
                    for($i=1;$i<=$total_page;$i++){
                            if($i==$start+1){
                                    echo "<a href='investigate_view.php?start=".$i."&limit=".$limit."&id=".$_GET[id]."'><button class='btn btn-default '><i class='fa fa-arrow-right'> ถัดไป</i></button></a>&nbsp;";
                            }
                    }
                    ?> 
                            
                        </center>

                
            </div>
         </div>
        </div>
    </div>
</body>

</html>
