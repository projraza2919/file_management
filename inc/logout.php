<?php  
session_start();
session_destroy();
/*
setcookie("username", "", time()-3600,"/");
setcookie("temp_password", "", time()-3600,"/");
setcookie("status", "", time()-3600,"/");
*/
header("Location:../login.php?stat=loggedout");
?>
