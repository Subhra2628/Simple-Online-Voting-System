<?php
include 'Voting_database.php';
session_start();
session_destroy();
session_unset();
echo "Log out";
header('Location:user_login_form.php');
exit;

?>