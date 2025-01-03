<?php
session_start();
session_destroy();
//header('Location: admin_login_form.php');
echo"Log Out Successfull";
header('Location:admin_login_form.php');
exit();
?>