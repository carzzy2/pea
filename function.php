<script language="javaScript">
function IsNumeric(sText,obj)
{
	var ValidChars = "0123456789-";
   var IsNumber=true;
   var Char;
   for (i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
   		if(IsNumber==false){
			alert("กรุณากรอกข้อมูลเป็นตัวเลข");
			obj.value=sText.substr(0,sText.length-1);
		}
   }
function isThaichar(){
if (event.keyCode>=161){
return true;
}else{
alert("ไม่สามารถกรอกเลขได้");
return false;
}
if (event.keyCode<65||event.keyCode>122) event.returnValue=false
}

function login_check(){
if(document.frm_login.username.value==""){
        alert ("กรุณากรอก Username !!");
        document.frm_login.username.focus();
        return false;
}
if(document.frm_login.password.value==""){
        alert ("กรุณากรอก Password !!");
        document.frm_login.password.focus();
        return false;
}
return true;
}


</script> 
