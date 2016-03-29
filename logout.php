<?php   
session_start();
session_destroy();
session_unset();
$_SESSION['FBID'] = NULL;
$_SESSION['FULLNAME'] = NULL;
$_SESSION['EMAIL'] =  NULL;
header("location:login-register.php");
exit();
?>
