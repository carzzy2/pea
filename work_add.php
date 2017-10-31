<?php
    session_start();
    include "connect_db.php";
    
    if(count($_SESSION['ss_user_id'])==0){
        $_SESSION['ss_user_id'][0]=$_GET['user_id'];

    }else{
        if(!in_array($_GET[user_id],$_SESSION['ss_user_id'])){
                $_SESSION['ss_user_id'][]=$_GET['user_id'];
        }
    }      
    echo "<META http-equiv='refresh' Content='0; URL=work_new.php'> ";
?>