<?php
@session_start();
if($_GET['re_id']==""){
    session_unregister("ss_re_id");
    session_unregister("ss_user_id");
}
$_SESSION['ss_re_id']=$_GET['re_id'];
echo "<META http-equiv='refresh' Content='0; URL=work_new.php'> ";

?>
