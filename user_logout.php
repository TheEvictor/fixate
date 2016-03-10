<?php
session_unset(); 
unset($_SESSION['usernameID']);
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION);
header('Location: index.php');
session_destroy(); 

exit;
?>