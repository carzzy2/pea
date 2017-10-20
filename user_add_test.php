 <?php
 @session_start();
include "connect_db.php";

if($_GET[mode]==""){
	$mode="add";
	$str="เพิ่มข้อมูล";
}elseif($_GET[mode]=="edit"){
	$enable="disabled=disabled";
	$mode=$_GET[mode];
	$id=$_GET[id];
	$str="แก้ไข";
	$sql_edit="select * from tb_user where user_id='".$id."'";
	$result_edit=mysql_db_query($dbname,$sql_edit);
	$array_edit=mysql_fetch_array($result_edit);
}
?>
<form method="post" id="frm"  action="#" onsubmit="return check_null()">
<div class="row">
            <div class="col-sm-12">
                <div class="row">

                <?php
                    $new_id =mysql_result(mysql_query("Select Max(substr(user_id,-4))+1 as MaxID from tb_user"),0,"MaxID" );
                    if($new_id==''){ // ถ้าได้เป็นค่าว่าง หรือ null ก็แสดงว่ายังไม่มีข้อมูลในฐานข้อมูล
                    $std_id="EMP00001";
                    }else{
                    $std_id="EMP".sprintf("%05d",$new_id);//ถ้าไม่ใช่ค่าว่าง
                    }
                ?>
                <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>รหัสเจ้าหน้าที่</label>
                            <? if($_GET[mode]=="edit"){ ?>
                            <input placeholder="กรุณากรอกข้อมูล" size="30" class="form-control" name="user_id1" type="text" id="user_id1" value="<?=$array_edit[user_id]?>"<?=$enable?>/>
                            <input  type="hidden" class="form-control "  name="user_id" id="user_id" value="<?=$array_edit[user_id]?>">
                            <?}elseif($_GET[mode]==""){ ?>
                            <input class="form-control" autocomplete=off  name="user_id" type="text" id="user_id1" value="<?=$std_id?>" size="30" readonly/>
                            <input  type="hidden" class="form-control "  name="user_id" id="user_id" value="<?=$std_id?>">
                            <? } ?>	
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>รหัสประชาชน</label> <!--<label style="color: red; font-weight: normal;">*กรอกตัวเลข13 หลัก</label> -->
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="user_code" type="text" id="user_code" value="<?=$array_edit[user_code]?>" onkeyup="IsNumeric(this.value,this)" maxlength="13" required/>	
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-3 form-group">
                                <label>คำนำหน้า</label>
                                <select id="user_first" class="form-control" name="user_first" required>
                                    <option style="display: none">--กรุณาเลือก--</option>
                                    <option value="0" <?php if($array_edit['user_first']=="0"){ echo "selected=selected"; }?>>นาย</option>
                                    <option value="1" <?php if($array_edit['user_first']=="1"){ echo "selected=selected"; }?>>นาง</option>
                                    <option value="2" <?php if($array_edit['user_first']=="2"){ echo "selected=selected"; }?>>นางสาว</option>
                                </select>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>ชื่อพนักงาน</label>
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="user_name" type="text" id="user_name" value="<?=$array_edit[user_name]?>" onkeypress="chThai()" required/>	
                            </div>
                            <div class="col-sm-5 form-group">
                                <label>นามสกุล</label>
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="user_last" type="text" id="user_last" value="<?=$array_edit[user_last]?>" onkeypress="chThai()" required/>	
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-5">
                                <label>ที่อยู่</label>
                                <textarea placeholder="กรุณากรอกข้อมูล" rows="1" name="user_add" class="form-control" required><?=$array_edit[user_add]?></textarea>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>เบอร์โทรศัพท์</label>
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="user_tel" type="text" id="user_tel" value="<?=$array_edit[user_tel]?>" onkeyup="IsNumeric(this.value,this)" maxlength="10" required/>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>ตำแหน่ง</label>
                                <div class="radio">
                                    <label><input disabled  name="user_pos" id="user_pos1" size="30" type="radio" value="0" <?php if($array_edit['user_pos']=="0"){ echo "checked"; }?>>&nbsp;ผู้ดูแลระบบ&nbsp;</label>
                                    <label><input disabled  name="user_pos" id="user_pos2" size="30" type="radio" value="1" <?php if($array_edit['user_pos']=="1"){ echo "checked"; }?>>&nbsp;พนักงาน&nbsp;</label>
                                </div>
                            </div>
                        </div>
                    <?php if($_GET[mode]=="edit"){ ?>
                    <input name="user_pass" type="hidden" id="user_pass" value="<?=$array_edit[user_pass]?>" >
                     <?php }else{ ?>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>รหัสผ่าน</label>
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="user_pass" type="password" id="user_pass" value="<?=$array_edit[user_pass]?>" >
                            </div>
                        </div>
                         <div class="row">
                            <div class="form-group col-sm-6">
                                <label>ยืนยันรหัสผ่าน</label>
                                <input class="form-control" autocomplete=off placeholder="กรุณากรอกข้อมูล" name="user_pass2" type="password" id="user_pass2" value="<?=$array_edit[user_pass]?>">
                            </div>
                        </div>
                    <script type="text/javascript">
                    $(document).ready(function() {
                    $("#user_pos2").attr('checked', true);
                    });
                    </script>
                    <script>
                    function check_null(){
                     var pass = $("#user_pass").val();
                     var pass2 = $("#user_pass2").val();
                     if(pass == ''){
                      alert("กรุณากรอก Password !");
                      $("#user_pass").focus();
                      return false;
                     }else if(pass2 == ''){
                      alert("กรุณากรอก Password อีกครั้ง !");
                      $("#user_pass2").focus();
                      return false;
                     }else if(pass != pass2){
                      alert("Password ไม่ตรงกัน!");
                      $("#user_pass2").focus();
                      return false;
                     }
                    }
                    </script>
                     <?php } ?>
                    <center>
                        
                        <input name="txtmode" type="hidden" id="txtmode" value="<?=$mode?>" />
                        <input name="txtid" type="hidden" id="txtid" value="<?=$id?>" />	
                    </center>
                </div>

        </div>
        </div>  					

</div>
<div class="modal-footer">
    
    <button class="btn btn-success" name="Submit" type="submit" ><i class="fa fa-check" > </i></button>
    <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-times"> ยกเลิก</i></button>
</div>
</form>
<script type="text/javascript">
$(document).ready(function() {
 
    $("#frm").on("submit", function(){
        console.log('55');
    });
});
</script>